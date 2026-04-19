<?php

declare(strict_types=1);

if (! function_exists('sanitize_inline_style_attribute')) {
    /**
     * Membolehkan properti CSS terbatas pada atribut style (warna, font dasar, rata teks, indent aman).
     */
    function sanitize_inline_style_attribute(string $raw): string
    {
        $raw = html_entity_decode(trim($raw), ENT_QUOTES | ENT_HTML5, 'UTF-8');
        if ($raw === '' || preg_match('/\burl\s*\(|expression\s*\(|@import|javascript\s*:/i', $raw)) {
            return '';
        }

        $allowed = [
            'color'              => 'color',
            'background-color'   => 'color',
            'text-align'         => 'text-align',
            'font-size'          => 'font-size',
            'font-family'        => 'font-family',
            'line-height'        => 'line-height',
            'margin-left'        => 'indent',
            'padding-left'       => 'indent',
            'text-indent'        => 'indent',
        ];

        $out = [];
        foreach (explode(';', $raw) as $piece) {
            $piece = trim($piece);
            if ($piece === '' || ! str_contains($piece, ':')) {
                continue;
            }
            [$prop, $value] = array_map('trim', explode(':', $piece, 2));
            $propLower = strtolower($prop);
            if (! isset($allowed[$propLower])) {
                continue;
            }

            $valueLower = strtolower($value);
            if (str_contains($valueLower, 'url(') || str_contains($valueLower, 'expression(')) {
                continue;
            }

            if ($propLower === 'text-align' && in_array($valueLower, ['left', 'right', 'center', 'justify'], true)) {
                $out[] = 'text-align:' . $valueLower;
                continue;
            }
            if ($propLower === 'font-size' && preg_match('/^[\d.]+\s*(px|pt|em|rem)$/i', $value) === 1) {
                $out[] = 'font-size:' . $value;
                continue;
            }
            if ($propLower === 'line-height' && (
                preg_match('/^normal$/i', $value) === 1
                || preg_match('/^[\d.]+\s*(px|pt|em|rem|%)$/i', $value) === 1
                || preg_match('/^[\d.]+%$/i', $value) === 1
                || preg_match('/^[\d.]+$/', $value) === 1
            )) {
                $out[] = 'line-height:' . $value;
                continue;
            }
            if ($propLower === 'font-family' && preg_match('/^[\pL\pM0-9\s,"\'-]+$/u', $value) === 1 && strlen($value) < 400) {
                $out[] = 'font-family:' . $value;
                continue;
            }
            if (in_array($propLower, ['margin-left', 'padding-left', 'text-indent'], true)) {
                // Batasi indent hanya nilai numerik dengan unit umum agar tetap aman.
                if (preg_match('/^0$/', $value) === 1 || preg_match('/^[\d.]+\s*(px|pt|em|rem|%)$/i', $value) === 1) {
                    $numeric = (float) preg_replace('/[^0-9.]/', '', $value);
                    if ($numeric <= 120) {
                        $out[] = $propLower . ':' . $value;
                    }
                }
                continue;
            }
            if (in_array($propLower, ['color', 'background-color'], true)) {
                if (preg_match('/url\s*\(/i', $value)) {
                    continue;
                }
                if (
                    preg_match('/^#([0-9a-f]{3}|[0-9a-f]{6})$/i', $value) === 1
                    || preg_match('/^rgba?\(\s*[\d\s.,%]+\)$/i', $value) === 1
                    || preg_match('/^hsla?\(\s*[\d\s.,%\-]+\)$/i', $value) === 1
                    || preg_match('/^[a-z][-a-z]*$/i', $value) === 1
                ) {
                    $out[] = $propLower . ':' . $value;
                }
            }
        }

        return implode('; ', $out);
    }
}

if (! function_exists('sanitize_style_attributes_in_html')) {
    function sanitize_style_attributes_in_html(string $html): string
    {
        return preg_replace_callback(
            '/\sstyle\s*=\s*("([^"]*)"|\'([^\']*)\')/i',
            static function (array $m): string {
                $raw = $m[2] !== '' ? $m[2] : ($m[3] ?? '');
                $clean = sanitize_inline_style_attribute($raw);

                return $clean === '' ? '' : ' style="' . esc($clean, 'attr') . '"';
            },
            $html
        ) ?? $html;
    }
}

if (! function_exists('safe_admin_html')) {
    /**
     * Membersihkan HTML dari panel admin sebelum disimpan atau ditampilkan.
     */
    function safe_admin_html(string $html): string
    {
        $html = preg_replace('/<\s*(script|style)\b[^>]*>[\s\S]*?<\s*\/\s*\1\s*>/i', '', $html) ?? $html;
        $html = preg_replace('/\son\w+\s*=\s*("[^"]*"|\'[^\']*\'|[^\s>]+)/i', '', $html) ?? $html;
        $html = sanitize_style_attributes_in_html($html);

        $allowed = '<p><div><span><br><strong><b><em><i><u><sub><sup><s><strike><del><ul><ol><li><h2><h3><h4><h5><h6>'
            . '<blockquote><a><hr><pre><code><table><thead><tbody><tfoot><tr><th><td><caption><col><colgroup>'
            . '<img><figure><figcaption><iframe>';
        $html = strip_tags($html, $allowed);

        $html = preg_replace_callback(
            '/<img\s+[^>]*>/i',
            static function (array $m): string {
                $tag = $m[0];
                if (! preg_match('/\bsrc\s*=\s*("[^"]*"|\'[^\']*\')/i', $tag, $sm)) {
                    return '';
                }
                $src = trim($sm[1], '"\'');
                if ($src === '' || preg_match('/^\s*javascript:/i', $src) || str_starts_with(strtolower($src), 'data:')) {
                    return '';
                }
                if (! preg_match('#^(https?:)?//#i', $src) && ! str_starts_with($src, '/')) {
                    return '';
                }

                $alt = '';
                if (preg_match('/\balt\s*=\s*("[^"]*"|\'[^\']*\')/i', $tag, $am)) {
                    $alt = esc(trim($am[1], '"\''), 'attr');
                }

                return '<img src="' . esc($src, 'attr') . '" alt="' . $alt . '" loading="lazy">';
            },
            $html
        ) ?? $html;

        $html = preg_replace_callback(
            '/<iframe\s+[^>]*>/i',
            static function (array $m): string {
                $tag = $m[0];
                if (! preg_match('/\bsrc\s*=\s*("[^"]*"|\'[^\']*\')/i', $tag, $sm)) {
                    return '';
                }
                $src = trim($sm[1], '"\'');
                $parts = parse_url($src);
                $host = strtolower($parts['host'] ?? '');
                $allowedHosts = [
                    'www.youtube.com',
                    'youtube.com',
                    'www.youtube-nocookie.com',
                    'youtube-nocookie.com',
                    'player.vimeo.com',
                    'www.google.com',
                    'maps.google.com',
                    'www.google.co.id',
                ];
                $ok = false;
                foreach ($allowedHosts as $h) {
                    if ($host === $h || str_ends_with($host, '.' . $h)) {
                        $ok = true;
                        break;
                    }
                }
                if (! $ok || ! str_starts_with(strtolower($parts['scheme'] ?? ''), 'http')) {
                    return '';
                }

                return '<iframe src="' . esc($src, 'attr') . '" title="Video" loading="lazy" allowfullscreen="true" '
                    . 'referrerpolicy="strict-origin-when-cross-origin"></iframe>';
            },
            $html
        ) ?? $html;

        $html = preg_replace_callback(
            '/<a\s+[^>]*?href\s*=\s*("[^"]*"|\'[^\']*\')[^>]*>/i',
            static function (array $m): string {
                $href = trim($m[1], '"\'');
                $hrefLower = strtolower($href);
                if ($hrefLower === '' || str_contains($hrefLower, 'javascript:') || str_starts_with($hrefLower, 'data:')) {
                    return '';
                }
                if (
                    ! preg_match('#^https?://#i', $hrefLower)
                    && ! str_starts_with($hrefLower, '/')
                    && ! str_starts_with($hrefLower, '#')
                    && ! str_starts_with($hrefLower, 'mailto:')
                ) {
                    return '';
                }

                return '<a href="' . esc($href, 'attr') . '" rel="noopener noreferrer">';
            },
            $html
        ) ?? $html;

        $html = preg_replace('/javascript:/i', '', $html) ?? $html;

        return preg_replace('/<div\b[^>]*>/i', '<div>', $html) ?? $html;
    }
}

if (! function_exists('plain_text_to_editor_html')) {
    /**
     * Mengubah teks polos (paragraf dipisah baris kosong ganda) menjadi HTML sederhana untuk editor.
     */
    function plain_text_to_editor_html(string $text): string
    {
        $text = trim($text);
        if ($text === '') {
            return '';
        }

        $parts = preg_split("/\R{2,}/", $text) ?: [];
        $blocks = [];
        foreach ($parts as $part) {
            $part = trim((string) $part);
            if ($part === '') {
                continue;
            }
            $blocks[] = '<p>' . nl2br(esc($part), false) . '</p>';
        }

        return implode('', $blocks);
    }
}

if (! function_exists('is_html_string')) {
    function is_html_string(string $value): bool
    {
        return (bool) preg_match('/<\s*[a-z][\s\S]*>/i', $value);
    }
}

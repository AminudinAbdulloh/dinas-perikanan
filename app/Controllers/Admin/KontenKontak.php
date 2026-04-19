<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BerandaModel;
use App\Models\SitePageModel;
use CodeIgniter\HTTP\ResponseInterface;

class KontenKontak extends BaseController
{
    protected $helpers = ['form', 'url'];

    public function index(): string
    {
        $page = $this->resolveKontakPage();

        return view('admin/konten/kontak', [
            'title'       => 'Konten Alamat dan Kontak',
            'adminNav'    => 'konten-kontak',
            'page'        => $page,
        ]);
    }

    public function edit(): string
    {
        $page = $this->resolveKontakPage();

        return view('admin/konten/kontak_edit', [
            'title'    => 'Edit Alamat dan Kontak',
            'adminNav' => 'konten-kontak',
            'page'     => $page,
        ]);
    }

    public function update(): ResponseInterface
    {
        $rules = [
            'title'       => 'required|max_length[255]',
            'description' => 'permit_empty|max_length[500]',
            'map_embed'   => 'permit_empty|max_length[2000]',
            'address'     => 'permit_empty|max_length[4000]',
            'email'       => 'permit_empty|max_length[255]|valid_email',
            'phone'       => 'permit_empty|max_length[120]',
            'socials'     => 'permit_empty|max_length[4000]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $slug = SitePageModel::SLUG_PROFIL_KONTAK;
        $mapEmbed = $this->sanitizeMapEmbed((string) $this->request->getPost('map_embed'));
        $socials = $this->parseSocialLinks((string) $this->request->getPost('socials'));

        $bodyPayload = [
            'map_embed' => $mapEmbed,
            'address'   => trim((string) $this->request->getPost('address')),
            'email'     => trim((string) $this->request->getPost('email')),
            'phone'     => trim((string) $this->request->getPost('phone')),
            'socials'   => $socials,
        ];

        $data = [
            'title'       => $this->request->getPost('title'),
            'description' => $this->request->getPost('description') ?: null,
            'body'        => (string) json_encode($bodyPayload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
        ];

        $model = model(SitePageModel::class);
        $existing = $model->where('slug', $slug)->first();

        if ($existing !== null) {
            $model->update((int) $existing['id'], $data);
        } else {
            $model->insert(array_merge(['slug' => $slug], $data));
        }

        return redirect()->to(base_url('admin/konten/kontak'))->with('message', 'Halaman Alamat dan Kontak berhasil disimpan.');
    }

    /**
     * @return array<string, mixed>
     */
    private function resolveKontakPage(): array
    {
        $slug = SitePageModel::SLUG_PROFIL_KONTAK;
        $row = model(SitePageModel::class)->findBySlug($slug);

        $fallback = [
            'map_embed' => 'https://www.google.com/maps?q=-3.3676,135.4972&z=15&output=embed',
            'address'   => 'Sanoba, Distrik Nabire, Kabupaten Nabire, Papua Tengah 98816',
            'email'     => 'dislautkan@papua.go.id',
            'phone'     => '(0123) 456789',
            'socials'   => [
                ['label' => 'Instagram', 'url' => 'https://instagram.com/'],
                ['label' => 'YouTube', 'url' => 'https://youtube.com/'],
            ],
        ];

        if ($row !== null) {
            $decoded = $this->decodeKontakBody((string) ($row['body'] ?? ''));

            return [
                'title'       => (string) $row['title'],
                'description' => (string) ($row['description'] ?? ''),
                'map_embed'   => $decoded['map_embed'] !== '' ? $decoded['map_embed'] : $fallback['map_embed'],
                'address'     => $decoded['address'] !== '' ? $decoded['address'] : $fallback['address'],
                'email'       => $decoded['email'] !== '' ? $decoded['email'] : $fallback['email'],
                'phone'       => $decoded['phone'] !== '' ? $decoded['phone'] : $fallback['phone'],
                'socials'     => $decoded['socials'] !== [] ? $decoded['socials'] : $fallback['socials'],
                'updated_at'  => (string) ($row['updated_at'] ?? ''),
            ];
        }

        $beranda = new BerandaModel();
        $public = $beranda->getPublicPageData('profil/kontak');

        return [
            'title'       => $public['title'] ?? 'Alamat dan Kontak',
            'description' => $public['description'] ?? '',
            'map_embed'   => $fallback['map_embed'],
            'address'     => $fallback['address'],
            'email'       => $fallback['email'],
            'phone'       => $fallback['phone'],
            'socials'     => $fallback['socials'],
            'updated_at'  => '',
        ];
    }

    /**
     * @return array{map_embed:string,address:string,email:string,phone:string,socials:array<int,array{label:string,url:string}>}
     */
    private function decodeKontakBody(string $body): array
    {
        $decoded = json_decode($body, true);
        if (! is_array($decoded)) {
            return [
                'map_embed' => '',
                'address'   => '',
                'email'     => '',
                'phone'     => '',
                'socials'   => [],
            ];
        }

        $socials = [];
        foreach (($decoded['socials'] ?? []) as $item) {
            if (! is_array($item)) {
                continue;
            }
            $label = trim((string) ($item['label'] ?? ''));
            $url = trim((string) ($item['url'] ?? ''));
            if ($label === '' || $url === '') {
                continue;
            }
            if (! filter_var($url, FILTER_VALIDATE_URL)) {
                continue;
            }
            $socials[] = ['label' => $label, 'url' => $url];
        }

        return [
            'map_embed' => $this->sanitizeMapEmbed((string) ($decoded['map_embed'] ?? '')),
            'address'   => trim((string) ($decoded['address'] ?? '')),
            'email'     => trim((string) ($decoded['email'] ?? '')),
            'phone'     => trim((string) ($decoded['phone'] ?? '')),
            'socials'   => $socials,
        ];
    }

    private function sanitizeMapEmbed(string $value): string
    {
        $value = trim($value);
        if ($value === '') {
            return '';
        }

        if (preg_match('/<iframe[^>]*src=("([^"]+)"|\'([^\']+)\')[^>]*>/i', $value, $m) === 1) {
            $value = trim((string) ($m[2] !== '' ? $m[2] : ($m[3] ?? '')));
        }

        $parts = parse_url($value);
        $host = strtolower((string) ($parts['host'] ?? ''));
        $scheme = strtolower((string) ($parts['scheme'] ?? ''));

        $allowedHosts = ['www.google.com', 'google.com', 'maps.google.com', 'www.google.co.id'];
        $isAllowedHost = in_array($host, $allowedHosts, true) || str_ends_with($host, '.google.com');
        $isEmbedPath = str_contains((string) ($parts['path'] ?? ''), '/maps');

        if (! $isAllowedHost || ! in_array($scheme, ['http', 'https'], true) || ! $isEmbedPath) {
            return '';
        }

        return $value;
    }

    /**
     * @return array<int, array{label:string,url:string}>
     */
    private function parseSocialLinks(string $raw): array
    {
        $items = [];
        $lines = preg_split('/\R+/', $raw) ?: [];
        foreach ($lines as $line) {
            $line = trim((string) $line);
            if ($line === '' || ! str_contains($line, '|')) {
                continue;
            }
            [$label, $url] = array_map('trim', explode('|', $line, 2));
            if ($label === '' || $url === '' || ! filter_var($url, FILTER_VALIDATE_URL)) {
                continue;
            }
            $items[] = ['label' => $label, 'url' => $url];
        }

        return $items;
    }
}

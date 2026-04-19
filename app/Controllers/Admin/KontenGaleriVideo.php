<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\GalleryVideoModel;
use CodeIgniter\HTTP\ResponseInterface;

class KontenGaleriVideo extends BaseController
{
    protected $helpers = ['form', 'url'];

    public function index(): string
    {
        $rows = model(GalleryVideoModel::class)->getAllForAdmin();

        return view('admin/konten/galeri_video_index', [
            'title'    => 'Galeri Video',
            'adminNav' => 'konten-galeri-video',
            'videos'   => $rows,
        ]);
    }

    public function create(): string
    {
        return view('admin/konten/galeri_video_form', [
            'title'      => 'Tambah Video',
            'adminNav'   => 'konten-galeri-video',
            'video'      => null,
            'formAction' => base_url('admin/konten/galeri-video/simpan'),
        ]);
    }

    public function store(): ResponseInterface
    {
        if (! $this->validate($this->validationRules())) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $parsed = $this->parseYouTubeFromUserInput((string) $this->request->getPost('youtube_input'));
        if ($parsed === null) {
            return redirect()->back()->withInput()->with('errors', ['youtube_input' => 'Tautan atau ID YouTube tidak valid.']);
        }

        model(GalleryVideoModel::class)->insert([
            'title'       => (string) $this->request->getPost('title'),
            'youtube_id'  => $parsed['youtube_id'],
            'youtube_url' => $parsed['youtube_url'],
            'duration'    => trim((string) $this->request->getPost('duration')) ?: null,
        ]);

        return redirect()->to(base_url('admin/konten/galeri-video'))->with('message', 'Video berhasil ditambahkan.');
    }

    public function edit(int $id): ResponseInterface|string
    {
        $row = model(GalleryVideoModel::class)->find($id);
        if ($row === null) {
            return redirect()->to(base_url('admin/konten/galeri-video'))->with('error', 'Video tidak ditemukan.');
        }

        return view('admin/konten/galeri_video_form', [
            'title'      => 'Edit Video',
            'adminNav'   => 'konten-galeri-video',
            'video'      => $row,
            'formAction' => base_url('admin/konten/galeri-video/' . $id . '/update'),
        ]);
    }

    public function update(int $id): ResponseInterface
    {
        $model = model(GalleryVideoModel::class);
        if ($model->find($id) === null) {
            return redirect()->to(base_url('admin/konten/galeri-video'))->with('error', 'Video tidak ditemukan.');
        }

        if (! $this->validate($this->validationRules())) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $parsed = $this->parseYouTubeFromUserInput((string) $this->request->getPost('youtube_input'));
        if ($parsed === null) {
            return redirect()->back()->withInput()->with('errors', ['youtube_input' => 'Tautan atau ID YouTube tidak valid.']);
        }

        $model->update($id, [
            'title'       => (string) $this->request->getPost('title'),
            'youtube_id'  => $parsed['youtube_id'],
            'youtube_url' => $parsed['youtube_url'],
            'duration'    => trim((string) $this->request->getPost('duration')) ?: null,
        ]);

        return redirect()->to(base_url('admin/konten/galeri-video'))->with('message', 'Video berhasil diperbarui.');
    }

    public function delete(int $id): ResponseInterface
    {
        $model = model(GalleryVideoModel::class);
        if ($model->find($id) === null) {
            return redirect()->to(base_url('admin/konten/galeri-video'))->with('error', 'Video tidak ditemukan.');
        }

        $model->delete($id);

        return redirect()->to(base_url('admin/konten/galeri-video'))->with('message', 'Video berhasil dihapus.');
    }

    /**
     * @return array<string, string>
     */
    private function validationRules(): array
    {
        return [
            'title'          => 'required|max_length[255]',
            'youtube_input'  => 'required|max_length[512]',
            'duration'       => 'permit_empty|max_length[16]',
        ];
    }

    /**
     * @return array{youtube_id: string, youtube_url: string}|null
     */
    private function parseYouTubeFromUserInput(string $raw): ?array
    {
        $raw = trim($raw);
        if ($raw === '') {
            return null;
        }

        if (preg_match('/^([a-zA-Z0-9_-]{11})$/', $raw, $m) === 1) {
            $id = $m[1];

            return [
                'youtube_id'  => $id,
                'youtube_url' => 'https://www.youtube.com/watch?v=' . $id,
            ];
        }

        $parts = parse_url($raw);
        if ($parts === false || empty($parts['host'])) {
            return null;
        }

        $host = strtolower((string) $parts['host']);
        $path = (string) ($parts['path'] ?? '');
        $query = (string) ($parts['query'] ?? '');

        $youtubeHosts = ['youtube.com', 'www.youtube.com', 'm.youtube.com', 'music.youtube.com', 'www.youtube-nocookie.com'];
        $isYoutube = false;
        foreach ($youtubeHosts as $h) {
            if ($host === $h || str_ends_with($host, '.' . $h)) {
                $isYoutube = true;
                break;
            }
        }

        if (str_contains($host, 'youtu.be')) {
            if (preg_match('#^/([a-zA-Z0-9_-]{11})(?:/|\?|$)#', $path, $m) === 1) {
                $id = $m[1];

                return ['youtube_id' => $id, 'youtube_url' => $raw];
            }

            return null;
        }

        if ($isYoutube) {
            parse_str($query, $qv);
            if (! empty($qv['v']) && preg_match('/^([a-zA-Z0-9_-]{11})$/', (string) $qv['v'], $m) === 1) {
                return ['youtube_id' => $m[1], 'youtube_url' => $raw];
            }
            if (preg_match('#^/embed/([a-zA-Z0-9_-]{11})#', $path, $m) === 1) {
                $id = $m[1];

                return ['youtube_id' => $id, 'youtube_url' => 'https://www.youtube.com/watch?v=' . $id];
            }
            if (preg_match('#^/shorts/([a-zA-Z0-9_-]{11})#', $path, $m) === 1) {
                $id = $m[1];

                return ['youtube_id' => $id, 'youtube_url' => 'https://www.youtube.com/watch?v=' . $id];
            }
            if (preg_match('#^/live/([a-zA-Z0-9_-]{11})#', $path, $m) === 1) {
                $id = $m[1];

                return ['youtube_id' => $id, 'youtube_url' => 'https://www.youtube.com/watch?v=' . $id];
            }
        }

        return null;
    }
}

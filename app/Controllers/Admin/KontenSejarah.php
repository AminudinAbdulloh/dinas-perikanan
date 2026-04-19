<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BerandaModel;
use App\Models\SitePageModel;
use CodeIgniter\HTTP\ResponseInterface;

class KontenSejarah extends BaseController
{
    protected $helpers = ['form', 'url', 'content'];

    public function index(): string
    {
        $page = $this->resolveSejarahPage();

        return view('admin/konten/sejarah', [
            'title'       => 'Konten Sejarah',
            'adminNav'    => 'konten-sejarah',
            'page'        => $page,
            'previewBody' => safe_admin_html((string) ($page['body'] ?? '')),
            'isHtmlBody'  => is_html_string((string) ($page['body'] ?? '')),
        ]);
    }

    public function edit(): string
    {
        $page = $this->resolveSejarahPage();

        if (($page['body'] ?? '') !== '' && ! is_html_string($page['body'])) {
            $page['body'] = plain_text_to_editor_html($page['body']);
        }

        return view('admin/konten/sejarah_edit', [
            'title'    => 'Edit Sejarah',
            'adminNav' => 'konten-sejarah',
            'page'     => $page,
        ]);
    }

    public function update(): ResponseInterface
    {
        $rules = [
            'title'       => 'required|max_length[255]',
            'description' => 'permit_empty|max_length[500]',
            'body'        => 'permit_empty|max_length[60000]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $slug = SitePageModel::SLUG_PROFIL_SEJARAH;
        $body = safe_admin_html((string) $this->request->getPost('body'));
        $data = [
            'title'         => $this->request->getPost('title'),
            'description'   => $this->request->getPost('description') ?: null,
            'body'          => $body,
        ];

        $model = model(SitePageModel::class);
        $existing = $model->where('slug', $slug)->first();

        if ($existing !== null) {
            $model->update((int) $existing['id'], $data);
        } else {
            $model->insert(array_merge(['slug' => $slug], $data));
        }

        return redirect()->to(base_url('admin/konten/sejarah'))->with('message', 'Halaman Sejarah berhasil disimpan.');
    }

    /**
     * @return array<string, mixed>
     */
    private function resolveSejarahPage(): array
    {
        $slug = SitePageModel::SLUG_PROFIL_SEJARAH;
        $row = model(SitePageModel::class)->findBySlug($slug);

        if ($row !== null) {
            return [
                'title'       => (string) $row['title'],
                'description' => (string) ($row['description'] ?? ''),
                'body'        => (string) ($row['body'] ?? ''),
                'updated_at'  => (string) ($row['updated_at'] ?? ''),
            ];
        }

        $beranda = new BerandaModel();
        $public = $beranda->getPublicPageData('profil/sejarah');

        return [
            'title'       => $public['title'] ?? 'Sejarah Dinas',
            'description' => $public['description'] ?? '',
            'body'        => $public['content'] ?? '',
            'updated_at'  => '',
        ];
    }
}

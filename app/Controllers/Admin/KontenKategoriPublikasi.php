<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PublicationCategoryModel;
use CodeIgniter\HTTP\ResponseInterface;

class KontenKategoriPublikasi extends BaseController
{
    protected $helpers = ['form', 'url'];

    public function index(): string
    {
        $model = model(PublicationCategoryModel::class);
        $grouped = $model->getAllGroupedByType();

        return view('admin/konten/kategori_publikasi_index', [
            'title'    => 'Kelola Kategori Publikasi',
            'adminNav' => 'kategori-publikasi',
            'grouped'  => $grouped,
            'typeLabels' => PublicationCategoryModel::publicationTypeLabels(),
        ]);
    }

    public function create(): string
    {
        return view('admin/konten/kategori_publikasi_form', [
            'title'      => 'Tambah Kategori Publikasi',
            'adminNav'   => 'kategori-publikasi',
            'item'       => null,
            'formAction' => base_url('admin/konten/kategori-publikasi/simpan'),
            'typeLabels' => PublicationCategoryModel::publicationTypeLabels(),
        ]);
    }

    public function store(): ResponseInterface
    {
        if (! $this->validate($this->validationRules())) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $name = (string) $this->request->getPost('name');
        $model = model(PublicationCategoryModel::class);
        $model->insert([
            'name'             => $name,
            'slug'             => PublicationCategoryModel::generateSlug($name),
            'publication_type' => (string) $this->request->getPost('publication_type'),
            'sort_order'       => (int) $this->request->getPost('sort_order'),
        ]);

        return redirect()->to(base_url('admin/konten/kategori-publikasi'))->with('message', 'Kategori publikasi berhasil ditambahkan.');
    }

    public function edit(int $id): ResponseInterface|string
    {
        $row = model(PublicationCategoryModel::class)->find($id);
        if ($row === null) {
            return redirect()->to(base_url('admin/konten/kategori-publikasi'))->with('error', 'Kategori tidak ditemukan.');
        }

        return view('admin/konten/kategori_publikasi_form', [
            'title'      => 'Edit Kategori Publikasi',
            'adminNav'   => 'kategori-publikasi',
            'item'       => $row,
            'formAction' => base_url('admin/konten/kategori-publikasi/' . $id . '/update'),
            'typeLabels' => PublicationCategoryModel::publicationTypeLabels(),
        ]);
    }

    public function update(int $id): ResponseInterface
    {
        $model = model(PublicationCategoryModel::class);
        if ($model->find($id) === null) {
            return redirect()->to(base_url('admin/konten/kategori-publikasi'))->with('error', 'Kategori tidak ditemukan.');
        }

        if (! $this->validate($this->validationRules())) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $name = (string) $this->request->getPost('name');
        $model->update($id, [
            'name'             => $name,
            'slug'             => PublicationCategoryModel::generateSlug($name),
            'publication_type' => (string) $this->request->getPost('publication_type'),
            'sort_order'       => (int) $this->request->getPost('sort_order'),
        ]);

        return redirect()->to(base_url('admin/konten/kategori-publikasi'))->with('message', 'Kategori publikasi berhasil diperbarui.');
    }

    public function delete(int $id): ResponseInterface
    {
        $model = model(PublicationCategoryModel::class);
        if ($model->find($id) === null) {
            return redirect()->to(base_url('admin/konten/kategori-publikasi'))->with('error', 'Kategori tidak ditemukan.');
        }

        $model->delete($id);

        return redirect()->to(base_url('admin/konten/kategori-publikasi'))->with('message', 'Kategori publikasi berhasil dihapus.');
    }

    /**
     * @return array<string, string>
     */
    private function validationRules(): array
    {
        return [
            'name'             => 'required|max_length[255]',
            'publication_type' => 'required|in_list[' . implode(',', PublicationCategoryModel::validPublicationTypes()) . ']',
            'sort_order'       => 'permit_empty|integer',
        ];
    }
}

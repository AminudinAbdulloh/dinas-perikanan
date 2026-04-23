<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PublicationTypeModel;
use CodeIgniter\HTTP\ResponseInterface;

class KontenTipePublikasi extends BaseController
{
    protected $helpers = ['form', 'url'];

    public function index(): string
    {
        $model = model(PublicationTypeModel::class);
        $types = $model->getAllForAdmin();

        return view('admin/konten/tipe_publikasi_index', [
            'title'    => 'Kelola Kategori Publikasi',
            'adminNav' => 'tipe-publikasi',
            'types'  => $types,
        ]);
    }

    public function create(): string
    {
        return view('admin/konten/tipe_publikasi_form', [
            'title'      => 'Tambah Kategori Publikasi',
            'adminNav'   => 'tipe-publikasi',
            'item'       => null,
            'formAction' => base_url('admin/konten/tipe-publikasi/simpan'),
        ]);
    }

    public function store(): ResponseInterface
    {
        if (! $this->validate($this->validationRules())) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $name = (string) $this->request->getPost('name');
        $model = model(PublicationTypeModel::class);
        $model->insert([
            'name'             => $name,
            'slug'             => PublicationTypeModel::generateSlug($name),
            'sort_order'       => (int) $this->request->getPost('sort_order'),
        ]);

        return redirect()->to(base_url('admin/konten/tipe-publikasi'))->with('message', 'Kategori publikasi berhasil ditambahkan.');
    }

    public function edit(int $id): ResponseInterface|string
    {
        $row = model(PublicationTypeModel::class)->find($id);
        if ($row === null) {
            return redirect()->to(base_url('admin/konten/tipe-publikasi'))->with('error', 'Kategori tidak ditemukan.');
        }

        return view('admin/konten/tipe_publikasi_form', [
            'title'      => 'Edit Kategori Publikasi',
            'adminNav'   => 'tipe-publikasi',
            'item'       => $row,
            'formAction' => base_url('admin/konten/tipe-publikasi/' . $id . '/update'),
        ]);
    }

    public function update(int $id): ResponseInterface
    {
        $model = model(PublicationTypeModel::class);
        if ($model->find($id) === null) {
            return redirect()->to(base_url('admin/konten/tipe-publikasi'))->with('error', 'Kategori tidak ditemukan.');
        }

        if (! $this->validate($this->validationRules())) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $name = (string) $this->request->getPost('name');
        $model->update($id, [
            'name'             => $name,
            'slug'             => PublicationTypeModel::generateSlug($name),
            'sort_order'       => (int) $this->request->getPost('sort_order'),
        ]);

        return redirect()->to(base_url('admin/konten/tipe-publikasi'))->with('message', 'Kategori publikasi berhasil diperbarui.');
    }

    public function delete(int $id): ResponseInterface
    {
        $model = model(PublicationTypeModel::class);
        if ($model->find($id) === null) {
            return redirect()->to(base_url('admin/konten/tipe-publikasi'))->with('error', 'Kategori tidak ditemukan.');
        }

        $model->delete($id);

        return redirect()->to(base_url('admin/konten/tipe-publikasi'))->with('message', 'Kategori publikasi berhasil dihapus.');
    }

    /**
     * @return array<string, string>
     */
    private function validationRules(): array
    {
        return [
            'name'             => 'required|max_length[255]',
            'sort_order'       => 'permit_empty|integer',
        ];
    }
}

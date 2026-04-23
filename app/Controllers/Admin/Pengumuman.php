<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PengumumanModel;
use CodeIgniter\HTTP\ResponseInterface;

class Pengumuman extends BaseController
{
    protected $helpers = ['form', 'url'];

    public function index(): string
    {
        $model = model(PengumumanModel::class);
        $rows  = $model->orderBy('id', 'DESC')->paginate(10, 'admin');

        return view('admin/pengumuman/index', [
            'title'      => 'Pengumuman',
            'adminNav'   => 'pengumuman',
            'pengumuman' => $rows,
            'pager'      => $model->pager,
        ]);
    }

    public function create(): string
    {
        return view('admin/pengumuman/form', [
            'title'      => 'Tambah Pengumuman',
            'adminNav'   => 'pengumuman',
            'pengumuman' => null,
            'formAction' => base_url('admin/pengumuman/simpan'),
        ]);
    }

    public function store(): ResponseInterface
    {
        if (! $this->validate($this->validationRules())) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $berkas = $this->request->getFile('berkas');
        $namaBerkas = null;

        if ($berkas && $berkas->isValid() && ! $berkas->hasMoved()) {
            $namaBerkas = $berkas->getRandomName();
            $berkas->move(FCPATH . 'uploads/pengumuman', $namaBerkas);
        }

        $model = model(PengumumanModel::class);

        $model->insert([
            'judul'     => (string) $this->request->getPost('judul'),
            'deskripsi' => (string) $this->request->getPost('deskripsi'),
            'berkas'    => $namaBerkas,
        ]);

        return redirect()->to(base_url('admin/pengumuman'))->with('message', 'Pengumuman berhasil ditambahkan.');
    }

    public function edit(int $id): ResponseInterface|string
    {
        $model = model(PengumumanModel::class);
        $row   = $model->find($id);
        if ($row === null) {
            return redirect()->to(base_url('admin/pengumuman'))->with('error', 'Pengumuman tidak ditemukan.');
        }

        return view('admin/pengumuman/form', [
            'title'      => 'Edit Pengumuman',
            'adminNav'   => 'pengumuman',
            'pengumuman' => $row,
            'formAction' => base_url('admin/pengumuman/' . $id . '/update'),
        ]);
    }

    public function update(int $id): ResponseInterface
    {
        $model = model(PengumumanModel::class);
        $row   = $model->find($id);
        if ($row === null) {
            return redirect()->to(base_url('admin/pengumuman'))->with('error', 'Pengumuman tidak ditemukan.');
        }

        if (! $this->validate($this->validationRules())) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $berkas = $this->request->getFile('berkas');
        $namaBerkas = $row['berkas'];

        if ($berkas && $berkas->isValid() && ! $berkas->hasMoved()) {
            if ($namaBerkas && file_exists(FCPATH . 'uploads/pengumuman/' . $namaBerkas)) {
                unlink(FCPATH . 'uploads/pengumuman/' . $namaBerkas);
            }
            $namaBerkas = $berkas->getRandomName();
            $berkas->move(FCPATH . 'uploads/pengumuman', $namaBerkas);
        }

        $model->update($id, [
            'judul'     => (string) $this->request->getPost('judul'),
            'deskripsi' => (string) $this->request->getPost('deskripsi'),
            'berkas'    => $namaBerkas,
        ]);

        return redirect()->to(base_url('admin/pengumuman'))->with('message', 'Pengumuman berhasil diperbarui.');
    }

    public function delete(int $id): ResponseInterface
    {
        $model = model(PengumumanModel::class);
        $row   = $model->find($id);
        if ($row === null) {
            return redirect()->to(base_url('admin/pengumuman'))->with('error', 'Pengumuman tidak ditemukan.');
        }

        if ($row['berkas'] && file_exists(FCPATH . 'uploads/pengumuman/' . $row['berkas'])) {
            unlink(FCPATH . 'uploads/pengumuman/' . $row['berkas']);
        }

        $model->delete($id);

        return redirect()->to(base_url('admin/pengumuman'))->with('message', 'Pengumuman berhasil dihapus.');
    }

    private function validationRules(): array
    {
        return [
            'judul'     => 'required|max_length[255]',
            'deskripsi' => 'required',
            'berkas'    => 'permit_empty|ext_in[berkas,pdf,doc,docx,jpg,jpeg,png]|max_size[berkas,5120]',
        ];
    }
}

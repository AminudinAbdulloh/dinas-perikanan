<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminUserModel;
use CodeIgniter\HTTP\ResponseInterface;

class ManajemenUser extends BaseController
{
    protected $helpers = ['form', 'url'];

    public function index(): string
    {
        $model = model(AdminUserModel::class);
        $users = $model->paginate(10, 'admin');

        return view('admin/users/index', [
            'title'    => 'Manajemen User Admin',
            'adminNav' => 'manajemen-user',
            'users'    => $users,
            'pager'    => $model->pager,
        ]);
    }

    public function create(): string
    {
        return view('admin/users/form', [
            'title'      => 'Tambah User Admin',
            'adminNav'   => 'manajemen-user',
            'user'       => null,
            'formAction' => base_url('admin/manajemen-user/simpan'),
        ]);
    }

    public function store(): ResponseInterface
    {
        $rules = [
            'name'     => 'required|max_length[100]',
            'email'    => 'required|valid_email|is_unique[admin_users.email]',
            'password' => 'required|min_length[8]',
            'status'   => 'required|in_list[1,0]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $model = model(AdminUserModel::class);
        $model->insert([
            'name'          => $this->request->getPost('name'),
            'email'         => $this->request->getPost('email'),
            'password_hash' => password_hash((string) $this->request->getPost('password'), PASSWORD_DEFAULT),
            'is_active'     => (int) $this->request->getPost('status'),
        ]);

        return redirect()->to(base_url('admin/manajemen-user'))->with('message', 'User admin berhasil ditambahkan.');
    }

    public function edit(int $id): ResponseInterface|string
    {
        $model = model(AdminUserModel::class);
        $user = $model->find($id);

        if ($user === null) {
            return redirect()->to(base_url('admin/manajemen-user'))->with('error', 'User tidak ditemukan.');
        }

        return view('admin/users/form', [
            'title'      => 'Edit User Admin',
            'adminNav'   => 'manajemen-user',
            'user'       => $user,
            'formAction' => base_url('admin/manajemen-user/' . $id . '/update'),
        ]);
    }

    public function update(int $id): ResponseInterface
    {
        $model = model(AdminUserModel::class);
        $user = $model->find($id);

        if ($user === null) {
            return redirect()->to(base_url('admin/manajemen-user'))->with('error', 'User tidak ditemukan.');
        }

        $rules = [
            'name'   => 'required|max_length[100]',
            'email'  => 'required|valid_email|is_unique[admin_users.email,id,' . $id . ']',
            'status' => 'required|in_list[1,0]',
        ];

        $password = (string) $this->request->getPost('password');
        if ($password !== '') {
            $rules['password'] = 'min_length[8]';
        }

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'name'      => $this->request->getPost('name'),
            'email'     => $this->request->getPost('email'),
            'is_active' => (int) $this->request->getPost('status'),
        ];

        if ($password !== '') {
            $data['password_hash'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $model->update($id, $data);

        return redirect()->to(base_url('admin/manajemen-user'))->with('message', 'User admin berhasil diperbarui.');
    }

    public function delete(int $id): ResponseInterface
    {
        $model = model(AdminUserModel::class);
        $user = $model->find($id);

        if ($user === null) {
            return redirect()->to(base_url('admin/manajemen-user'))->with('error', 'User tidak ditemukan.');
        }

        if ((int) session('admin_id') === $id) {
            return redirect()->to(base_url('admin/manajemen-user'))->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $model->delete($id);

        return redirect()->to(base_url('admin/manajemen-user'))->with('message', 'User admin berhasil dihapus.');
    }
}

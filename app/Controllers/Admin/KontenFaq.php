<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\FaqModel;
use CodeIgniter\HTTP\ResponseInterface;

class KontenFaq extends BaseController
{
    protected $helpers = ['form', 'url'];

    public function index(): string
    {
        $rows = model(FaqModel::class)->getAllForAdmin();

        return view('admin/konten/faq_index', [
            'title'    => 'FAQ',
            'adminNav' => 'konten-faq',
            'faqs'     => $rows,
        ]);
    }

    public function create(): string
    {
        return view('admin/konten/faq_form', [
            'title'      => 'Tambah FAQ',
            'adminNav'   => 'konten-faq',
            'faq'        => null,
            'formAction' => base_url('admin/konten/faq/simpan'),
        ]);
    }

    public function store(): ResponseInterface
    {
        if (! $this->validate($this->validationRules())) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $model = model(FaqModel::class);

        $model->insert([
            'question'   => (string) $this->request->getPost('question'),
            'answer'     => (string) $this->request->getPost('answer'),
            'sort_order' => $model->getNextSortOrder(),
            'is_active'  => $this->request->getPost('is_active') ? 1 : 0,
        ]);

        return redirect()->to(base_url('admin/konten/faq'))->with('message', 'FAQ berhasil ditambahkan.');
    }

    public function edit(int $id): ResponseInterface|string
    {
        $row = model(FaqModel::class)->find($id);
        if ($row === null) {
            return redirect()->to(base_url('admin/konten/faq'))->with('error', 'FAQ tidak ditemukan.');
        }

        return view('admin/konten/faq_form', [
            'title'      => 'Edit FAQ',
            'adminNav'   => 'konten-faq',
            'faq'        => $row,
            'formAction' => base_url('admin/konten/faq/' . $id . '/update'),
        ]);
    }

    public function update(int $id): ResponseInterface
    {
        $model = model(FaqModel::class);
        if ($model->find($id) === null) {
            return redirect()->to(base_url('admin/konten/faq'))->with('error', 'FAQ tidak ditemukan.');
        }

        if (! $this->validate($this->validationRules())) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $model->update($id, [
            'question'   => (string) $this->request->getPost('question'),
            'answer'     => (string) $this->request->getPost('answer'),
            'sort_order' => (int) $this->request->getPost('sort_order'),
            'is_active'  => $this->request->getPost('is_active') ? 1 : 0,
        ]);

        return redirect()->to(base_url('admin/konten/faq'))->with('message', 'FAQ berhasil diperbarui.');
    }

    public function delete(int $id): ResponseInterface
    {
        $model = model(FaqModel::class);
        if ($model->find($id) === null) {
            return redirect()->to(base_url('admin/konten/faq'))->with('error', 'FAQ tidak ditemukan.');
        }

        $model->delete($id);

        return redirect()->to(base_url('admin/konten/faq'))->with('message', 'FAQ berhasil dihapus.');
    }

    /**
     * @return array<string, string>
     */
    private function validationRules(): array
    {
        return [
            'question' => 'required|max_length[500]',
            'answer'   => 'required|max_length[10000]',
        ];
    }
}

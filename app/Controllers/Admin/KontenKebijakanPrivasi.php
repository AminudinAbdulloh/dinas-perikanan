<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PrivacyPolicyModel;
use CodeIgniter\HTTP\ResponseInterface;

class KontenKebijakanPrivasi extends BaseController
{
    protected $helpers = ['form', 'url', 'content'];

    public function index(): string
    {
        $model = new PrivacyPolicyModel();
        $policy = $model->getPolicy();

        return view('admin/konten/kebijakan_privasi', [
            'title'       => 'Kebijakan Privasi',
            'adminNav'    => 'konten-kebijakan-privasi',
            'policy'      => $policy,
            'previewBody' => safe_admin_html((string) ($policy['content'] ?? '')),
            'isHtmlBody'  => is_html_string((string) ($policy['content'] ?? '')),
        ]);
    }

    public function edit(): string
    {
        $model = new PrivacyPolicyModel();
        $policy = $model->getPolicy();

        if (($policy['content'] ?? '') !== '' && ! is_html_string($policy['content'])) {
            $policy['content'] = plain_text_to_editor_html($policy['content']);
        }

        return view('admin/konten/kebijakan_privasi_edit', [
            'title'    => 'Edit Kebijakan Privasi',
            'adminNav' => 'konten-kebijakan-privasi',
            'policy'   => $policy,
        ]);
    }

    public function update(): ResponseInterface
    {
        $rules = [
            'content' => 'permit_empty|max_length[60000]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $content = safe_admin_html((string) $this->request->getPost('content'));

        $model = new PrivacyPolicyModel();
        $model->updatePolicy($content);

        cleanup_unused_editor_uploads();

        return redirect()->to(base_url('admin/konten/kebijakan-privasi'))->with('message', 'Kebijakan Privasi berhasil disimpan.');
    }
}

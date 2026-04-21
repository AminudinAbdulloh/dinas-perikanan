<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SitePageModel;
use CodeIgniter\HTTP\ResponseInterface;

class PengaturanBeranda extends BaseController
{
    public function index(): string
    {
        $model = model(SitePageModel::class);
        $setting = $model->findBySlug(SitePageModel::SLUG_PENGATURAN_BERANDA);

        $data = [
            'title' => 'Pengaturan Beranda',
            'setting' => $setting,
        ];

        return view('admin/pengaturan_beranda/index', $data);
    }

    public function update(): ResponseInterface
    {
        $rules = [
            'hero_bg' => 'permit_empty|uploaded[hero_bg]|is_image[hero_bg]|mime_in[hero_bg,image/jpg,image/jpeg,image/png,image/webp]|max_size[hero_bg,4096]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $model = model(SitePageModel::class);
        $setting = $model->findBySlug(SitePageModel::SLUG_PENGATURAN_BERANDA);

        $imageFile = $this->request->getFile('hero_bg');
        $bodyVal = $setting['body'] ?? '';

        if ($imageFile !== null && $imageFile->isValid() && !$imageFile->hasMoved()) {
            $newName = $imageFile->getRandomName();
            $imageFile->move(FCPATH . 'uploads/hero', $newName);
            
            // Delete old file if exists
            if (!empty($setting['body']) && file_exists(FCPATH . $setting['body'])) {
                @unlink(FCPATH . $setting['body']);
            }
            
            $bodyVal = 'uploads/hero/' . $newName;
        }

        if ($setting === null) {
            $model->insert([
                'slug' => SitePageModel::SLUG_PENGATURAN_BERANDA,
                'title' => 'Pengaturan Beranda',
                'description' => 'Pengaturan halaman utama',
                'body' => $bodyVal,
            ]);
        } else {
            $model->update($setting['id'], [
                'body' => $bodyVal,
            ]);
        }

        return redirect()->to(base_url('admin/pengaturan-beranda'))
            ->with('success', 'Pengaturan beranda berhasil disimpan.');
    }
}

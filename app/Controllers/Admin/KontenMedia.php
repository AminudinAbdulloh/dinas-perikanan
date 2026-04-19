<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class KontenMedia extends BaseController
{
    public function uploadImage(): ResponseInterface
    {
        $file = $this->request->getFile('file');
        if ($file === null || ! $file->isValid() || $file->hasMoved()) {
            return $this->response->setStatusCode(400)->setJSON([
                'error' => 'File gambar tidak valid.',
            ]);
        }

        $ext = strtolower($file->getClientExtension() ?: '');
        $allowedExt = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
        if (! in_array($ext, $allowedExt, true)) {
            return $this->response->setStatusCode(422)->setJSON([
                'error' => 'Format gambar tidak didukung.',
            ]);
        }

        $sizeBytes = (int) $file->getSize();
        if ($sizeBytes <= 0 || $sizeBytes > 5 * 1024 * 1024) {
            return $this->response->setStatusCode(422)->setJSON([
                'error' => 'Ukuran gambar maksimal 5MB.',
            ]);
        }

        $mime = strtolower($file->getMimeType() ?? '');
        $allowedMime = [
            'image/jpeg',
            'image/png',
            'image/webp',
            'image/gif',
        ];
        if ($mime === '' || ! in_array($mime, $allowedMime, true)) {
            return $this->response->setStatusCode(422)->setJSON([
                'error' => 'MIME type gambar tidak valid.',
            ]);
        }

        $targetDir = rtrim(FCPATH, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'editor';
        if (! is_dir($targetDir) && ! mkdir($targetDir, 0755, true) && ! is_dir($targetDir)) {
            return $this->response->setStatusCode(500)->setJSON([
                'error' => 'Gagal menyiapkan direktori upload.',
            ]);
        }

        $newName = $file->getRandomName();
        $file->move($targetDir, $newName);

        // Buat URL yang tetap benar walau aplikasi jalan di subfolder (mis. /dinas-perikanan/public)
        $scriptName = (string) ($this->request->getServer('SCRIPT_NAME') ?? '');
        $basePath = str_replace('\\', '/', dirname($scriptName));
        $basePath = $basePath === '/' ? '' : rtrim($basePath, '/');

        return $this->response->setJSON([
            'location' => $basePath . '/uploads/editor/' . $newName,
        ]);
    }
}

<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\InformationObjectionModel;
use CodeIgniter\HTTP\ResponseInterface;

class KontenKeberatanInformasi extends BaseController
{
    protected $helpers = ['form', 'url'];

    public function index(): string
    {
        $status = $this->request->getGet('status');
        $model = model(InformationObjectionModel::class);

        if ($status !== null && !in_array($status, InformationObjectionModel::validStatuses(), true)) {
            $status = null;
        }

        $rows = $model->getAllForAdmin($status);

        return view('admin/konten/keberatan_informasi_index', [
            'title'        => 'Kelola Keberatan Informasi',
            'adminNav'     => 'konten-keberatan-informasi',
            'items'        => $rows,
            'activeStatus' => $status,
            'statuses'     => InformationObjectionModel::statusLabels(),
        ]);
    }

    public function detail(int $id): ResponseInterface|string
    {
        $row = model(InformationObjectionModel::class)->find($id);
        if ($row === null) {
            return redirect()->to(base_url('admin/konten/keberatan-informasi'))->with('error', 'Data tidak ditemukan.');
        }

        return view('admin/konten/keberatan_informasi_detail', [
            'title'    => 'Detail Keberatan #' . esc((string) $row['registration_number']),
            'adminNav' => 'konten-keberatan-informasi',
            'item'     => $row,
            'statuses' => InformationObjectionModel::statusLabels(),
        ]);
    }

    public function updateStatus(int $id): ResponseInterface
    {
        $model = model(InformationObjectionModel::class);
        $existing = $model->find($id);
        if ($existing === null) {
            return redirect()->to(base_url('admin/konten/keberatan-informasi'))->with('error', 'Data tidak ditemukan.');
        }

        $newStatus = (string) $this->request->getPost('status');
        if (!in_array($newStatus, InformationObjectionModel::validStatuses(), true)) {
            return redirect()->back()->with('error', 'Status tidak valid.');
        }

        $adminNotes = trim((string) $this->request->getPost('admin_notes'));

        $model->update($id, [
            'status'      => $newStatus,
            'admin_notes' => $adminNotes !== '' ? $adminNotes : null,
        ]);

        return redirect()->to(base_url('admin/konten/keberatan-informasi/' . $id))
            ->with('message', 'Status keberatan berhasil diperbarui.');
    }

    public function delete(int $id): ResponseInterface
    {
        $model = model(InformationObjectionModel::class);
        $row = $model->find($id);
        if ($row === null) {
            return redirect()->to(base_url('admin/konten/keberatan-informasi'))->with('error', 'Data tidak ditemukan.');
        }

        // Delete attachment file if exists
        $attachPath = trim((string) ($row['attachment_path'] ?? ''));
        if ($attachPath !== '' && !preg_match('#^https?://#i', $attachPath)) {
            $fullPath = rtrim(FCPATH, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, ltrim($attachPath, '/'));
            if (is_file($fullPath)) {
                @unlink($fullPath);
            }
        }

        $model->delete($id);

        return redirect()->to(base_url('admin/konten/keberatan-informasi'))->with('message', 'Keberatan berhasil dihapus.');
    }
}

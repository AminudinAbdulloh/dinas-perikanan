<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\InformationRequestModel;
use CodeIgniter\HTTP\ResponseInterface;

class KontenPermohonanInformasi extends BaseController
{
    protected $helpers = ['form', 'url'];

    public function index(): string
    {
        $status = $this->request->getGet('status');
        $model = model(InformationRequestModel::class);

        if ($status !== null && !in_array($status, InformationRequestModel::validStatuses(), true)) {
            $status = null;
        }

        $rows = $model->getAllForAdmin($status);

        return view('admin/konten/permohonan_informasi_index', [
            'title'        => 'Kelola Permohonan Informasi',
            'adminNav'     => 'konten-permohonan-informasi',
            'items'        => $rows,
            'activeStatus' => $status,
            'statuses'     => InformationRequestModel::statusLabels(),
        ]);
    }

    public function detail(int $id): ResponseInterface|string
    {
        $row = model(InformationRequestModel::class)->find($id);
        if ($row === null) {
            return redirect()->to(base_url('admin/konten/permohonan-informasi'))->with('error', 'Data tidak ditemukan.');
        }

        return view('admin/konten/permohonan_informasi_detail', [
            'title'    => 'Detail Permohonan #' . esc((string) $row['registration_number']),
            'adminNav' => 'konten-permohonan-informasi',
            'item'     => $row,
            'statuses' => InformationRequestModel::statusLabels(),
        ]);
    }

    public function updateStatus(int $id): ResponseInterface
    {
        $model = model(InformationRequestModel::class);
        $existing = $model->find($id);
        if ($existing === null) {
            return redirect()->to(base_url('admin/konten/permohonan-informasi'))->with('error', 'Data tidak ditemukan.');
        }

        $newStatus = (string) $this->request->getPost('status');
        if (!in_array($newStatus, InformationRequestModel::validStatuses(), true)) {
            return redirect()->back()->with('error', 'Status tidak valid.');
        }

        $adminNotes = trim((string) $this->request->getPost('admin_notes'));

        $model->update($id, [
            'status'      => $newStatus,
            'admin_notes' => $adminNotes !== '' ? $adminNotes : null,
        ]);

        return redirect()->to(base_url('admin/konten/permohonan-informasi/' . $id))
            ->with('message', 'Status permohonan berhasil diperbarui.');
    }

    public function delete(int $id): ResponseInterface
    {
        $model = model(InformationRequestModel::class);
        $row = $model->find($id);
        if ($row === null) {
            return redirect()->to(base_url('admin/konten/permohonan-informasi'))->with('error', 'Data tidak ditemukan.');
        }

        $model->delete($id);

        return redirect()->to(base_url('admin/konten/permohonan-informasi'))->with('message', 'Permohonan berhasil dihapus.');
    }
}

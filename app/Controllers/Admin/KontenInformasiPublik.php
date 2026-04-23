<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PublicInformationModel;
use App\Models\PublicationCategoryModel;
use CodeIgniter\HTTP\ResponseInterface;

class KontenInformasiPublik extends BaseController
{
    protected $helpers = ['form', 'url'];

    public function index(): string
    {
        $category = $this->request->getGet('kategori');
        $model = model(PublicInformationModel::class);

        if ($category !== null && !in_array($category, PublicInformationModel::validCategories(), true)) {
            $category = null;
        }

        $rows = $model->getAllForAdmin($category);

        return view('admin/konten/informasi_publik_index', [
            'title'          => 'Kelola Informasi Publik',
            'adminNav'       => 'mod-ppid',
            'items'          => $rows,
            'activeCategory' => $category,
            'categories'     => PublicInformationModel::categoryLabels(),
            'pager'          => $model->pager,
        ]);
    }

    public function create(): string
    {
        $pubCategories = PublicationCategoryModel::tableReady()
            ? model(PublicationCategoryModel::class)->getAllForSelect()
            : [];

        return view('admin/konten/informasi_publik_form', [
            'title'         => 'Tambah Informasi Publik',
            'adminNav'      => 'mod-ppid',
            'item'          => null,
            'formAction'    => base_url('admin/konten/informasi-publik/simpan'),
            'categories'    => PublicInformationModel::categoryLabels(),
            'pubTypeLabels' => PublicationCategoryModel::publicationTypeLabels(),
            'pubCategories' => $pubCategories,
        ]);
    }

    public function store(): ResponseInterface
    {
        if (! $this->validate($this->validationRules())) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $filePath = $this->resolveFileUpload(true, null);

        $model = model(PublicInformationModel::class);
        $model->insert($this->buildPayload($filePath));

        return redirect()->to(base_url('admin/konten/informasi-publik'))->with('message', 'Informasi publik berhasil ditambahkan.');
    }

    public function edit(int $id): ResponseInterface|string
    {
        $row = model(PublicInformationModel::class)->find($id);
        if ($row === null) {
            return redirect()->to(base_url('admin/konten/informasi-publik'))->with('error', 'Data tidak ditemukan.');
        }

        $pubCategories = PublicationCategoryModel::tableReady()
            ? model(PublicationCategoryModel::class)->getAllForSelect()
            : [];

        return view('admin/konten/informasi_publik_form', [
            'title'         => 'Edit Informasi Publik',
            'adminNav'      => 'mod-ppid',
            'item'          => $row,
            'formAction'    => base_url('admin/konten/informasi-publik/' . $id . '/update'),
            'categories'    => PublicInformationModel::categoryLabels(),
            'pubTypeLabels' => PublicationCategoryModel::publicationTypeLabels(),
            'pubCategories' => $pubCategories,
        ]);
    }

    public function update(int $id): ResponseInterface
    {
        $model = model(PublicInformationModel::class);
        $existing = $model->find($id);
        if ($existing === null) {
            return redirect()->to(base_url('admin/konten/informasi-publik'))->with('error', 'Data tidak ditemukan.');
        }

        if (! $this->validate($this->validationRules())) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $previousFile = (string) ($existing['file_path'] ?? '');
        $filePath = $this->resolveFileUpload(false, $previousFile);

        $payload = $this->buildPayload($filePath);
        $model->update($id, $payload);

        if ($filePath !== $previousFile && $this->isStoredFilePath($previousFile)) {
            $this->deleteStoredFile($previousFile);
        }

        return redirect()->to(base_url('admin/konten/informasi-publik'))->with('message', 'Informasi publik berhasil diperbarui.');
    }

    public function delete(int $id): ResponseInterface
    {
        $model = model(PublicInformationModel::class);
        $row = $model->find($id);
        if ($row === null) {
            return redirect()->to(base_url('admin/konten/informasi-publik'))->with('error', 'Data tidak ditemukan.');
        }

        $file = (string) ($row['file_path'] ?? '');
        $model->delete($id);

        if ($this->isStoredFilePath($file)) {
            $this->deleteStoredFile($file);
        }

        return redirect()->to(base_url('admin/konten/informasi-publik'))->with('message', 'Informasi publik berhasil dihapus.');
    }

    /**
     * @return array<string, string>
     */
    private function validationRules(): array
    {
        return [
            'title'              => 'required|max_length[500]',
            'category'           => 'required|in_list[' . implode(',', PublicInformationModel::validCategories()) . ']',
            'description'        => 'permit_empty|max_length[5000]',
            'responsible_party'  => 'permit_empty|max_length[255]',
            'time_period'        => 'permit_empty|max_length[100]',
            'information_format' => 'permit_empty|max_length[100]',
            'year'               => 'permit_empty|integer|greater_than[1900]|less_than[2100]',
            'status'             => 'required|in_list[draft,publish]',
        ];
    }

    /**
     * @return array<string, mixed>
     */
    private function buildPayload(?string $filePath): array
    {
        $status = (string) $this->request->getPost('status');
        $category = (string) $this->request->getPost('category');
        $file = $this->request->getFile('document');
        $fileName = null;

        if ($file !== null && $file->isValid() && !$file->hasMoved()) {
            $fileName = $file->getClientName();
        } elseif ($filePath !== null) {
            $fileName = trim((string) $this->request->getPost('current_file_name'));
        }

        $payload = [
            'title'              => (string) $this->request->getPost('title'),
            'category'           => $category,
            'description'        => trim((string) $this->request->getPost('description')) ?: null,
            'responsible_party'  => trim((string) $this->request->getPost('responsible_party')) ?: null,
            'time_period'        => trim((string) $this->request->getPost('time_period')) ?: null,
            'information_format' => trim((string) $this->request->getPost('information_format')) ?: null,
            'year'               => trim((string) $this->request->getPost('year')) !== '' ? (int) $this->request->getPost('year') : null,
            'is_published'       => $status === 'publish' ? 1 : 0,
        ];

        // Publication fields (only for non-dikecualikan)
        if ($category !== 'dikecualikan') {
            $pubType = trim((string) $this->request->getPost('publication_type'));
            $pubCatId = trim((string) $this->request->getPost('publication_category_id'));
            $payload['publication_type'] = $pubType !== '' ? $pubType : null;
            $payload['publication_category_id'] = $pubCatId !== '' ? (int) $pubCatId : null;
        } else {
            $payload['publication_type'] = null;
            $payload['publication_category_id'] = null;
        }

        if ($filePath !== null) {
            $payload['file_path'] = $filePath;
            if ($fileName) {
                $payload['file_name'] = $fileName;
            }
        }

        return $payload;
    }

    private function resolveFileUpload(bool $isCreate, ?string $previousStored): ?string
    {
        $file = $this->request->getFile('document');
        if ($file !== null && $file->isValid() && !$file->hasMoved()) {
            $stored = $this->storeDocumentFile($file);
            if ($stored !== null) {
                return $stored;
            }
        }

        if ($isCreate) {
            return null;
        }

        $current = trim((string) $this->request->getPost('current_file'));
        if ($current !== '') {
            return $current;
        }

        return $previousStored !== '' ? $previousStored : null;
    }

    private function storeDocumentFile(object $file): ?string
    {
        $ext = strtolower($file->getClientExtension() ?: '');
        $allowedExt = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'jpg', 'jpeg', 'png', 'webp', 'zip', 'rar'];
        if (!in_array($ext, $allowedExt, true)) {
            return null;
        }

        $sizeBytes = (int) $file->getSize();
        if ($sizeBytes <= 0 || $sizeBytes > 25 * 1024 * 1024) {
            return null;
        }

        $targetDir = rtrim(FCPATH, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'informasi-publik';
        if (!is_dir($targetDir) && !mkdir($targetDir, 0755, true) && !is_dir($targetDir)) {
            return null;
        }

        $newName = $file->getRandomName();
        $file->move($targetDir, $newName);

        return 'uploads/informasi-publik/' . $newName;
    }

    private function isStoredFilePath(string $stored): bool
    {
        $stored = trim($stored);
        if ($stored === '' || preg_match('#^https?://#i', $stored) === 1) {
            return false;
        }

        return str_starts_with(ltrim($stored, '/'), 'uploads/informasi-publik/');
    }

    private function deleteStoredFile(string $stored): void
    {
        if (!$this->isStoredFilePath($stored)) {
            return;
        }

        $rel = ltrim($stored, '/');
        $path = rtrim(FCPATH, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $rel);
        if (is_file($path)) {
            @unlink($path);
        }
    }
}

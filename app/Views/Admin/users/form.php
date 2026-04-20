<?= $this->extend('layouts/template_admin') ?>

<?= $this->section('content') ?>
<div class="mb-4">
    <a href="<?= base_url('admin/manajemen-user') ?>" class="btn btn-outline-secondary btn-sm rounded-3 mb-3">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>
    <h1 class="h3 mb-0 text-gray-800"><?= esc($title) ?></h1>
</div>

<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-4">
        <form action="<?= $formAction ?>" method="post">
            <?= csrf_field() ?>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="name" class="form-label fw-medium">Nama Lengkap <span class="text-danger">*</span></label>
                    <input type="text" class="form-control rounded-3 <?= session('errors.name') ? 'is-invalid' : '' ?>" id="name" name="name" value="<?= old('name', $user['name'] ?? '') ?>" required>
                    <?php if (session('errors.name')) : ?>
                        <div class="invalid-feedback"><?= esc(session('errors.name')) ?></div>
                    <?php endif; ?>
                </div>
                <div class="col-md-6 mt-3 mt-md-0">
                    <label for="email" class="form-label fw-medium">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control rounded-3 <?= session('errors.email') ? 'is-invalid' : '' ?>" id="email" name="email" value="<?= old('email', $user['email'] ?? '') ?>" required>
                    <?php if (session('errors.email')) : ?>
                        <div class="invalid-feedback"><?= esc(session('errors.email')) ?></div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="password" class="form-label fw-medium">Kata Sandi <?= $user ? '<span class="text-muted fw-normal small">(Kosongkan jika tidak ingin mengubah)</span>' : '<span class="text-danger">*</span>' ?></label>
                    <input type="password" class="form-control rounded-3 <?= session('errors.password') ? 'is-invalid' : '' ?>" id="password" name="password" <?= $user ? '' : 'required' ?> minlength="8">
                    <?php if (session('errors.password')) : ?>
                        <div class="invalid-feedback"><?= esc(session('errors.password')) ?></div>
                    <?php else: ?>
                        <div class="form-text">Minimal 8 karakter.</div>
                    <?php endif; ?>
                </div>
                <div class="col-md-6 mt-3 mt-md-0">
                    <label for="status" class="form-label fw-medium">Status Akun <span class="text-danger">*</span></label>
                    <select class="form-select rounded-3 <?= session('errors.status') ? 'is-invalid' : '' ?>" id="status" name="status" required>
                        <option value="1" <?= old('status', $user['is_active'] ?? '1') == '1' ? 'selected' : '' ?>>Aktif</option>
                        <option value="0" <?= old('status', $user['is_active'] ?? '') == '0' ? 'selected' : '' ?>>Nonaktif</option>
                    </select>
                    <?php if (session('errors.status')) : ?>
                        <div class="invalid-feedback"><?= esc(session('errors.status')) ?></div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="text-end mt-4">
                <button type="submit" class="btn btn-primary rounded-3 px-4">Simpan User</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>

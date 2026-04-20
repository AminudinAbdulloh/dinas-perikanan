<div class="info-form-wrapper">
    <?php if (session()->getFlashdata('keberatan_success')) : ?>
        <div class="alert alert-success rounded-3 mb-3" role="alert">
            <i class="bi bi-check-circle me-1"></i>
            <?= esc(session()->getFlashdata('keberatan_success')) ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('keberatan_error')) : ?>
        <div class="alert alert-danger rounded-3 mb-3" role="alert">
            <i class="bi bi-exclamation-triangle me-1"></i>
            <?= esc(session()->getFlashdata('keberatan_error')) ?>
        </div>
    <?php endif; ?>

    <?php
    $errs = session()->getFlashdata('errors');
    if (is_array($errs) && $errs !== []) : ?>
        <div class="alert alert-danger rounded-3 mb-3">
            <ul class="mb-0 ps-3">
                <?php foreach ($errs as $err) : ?>
                    <li><?= esc(is_string($err) ? $err : (string) $err) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form class="info-form-layout" action="<?= base_url('layanan/form-keberatan-informasi/kirim') ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <div class="form-block">
            <label for="keberatan-nama" class="form-title">Nama Pemohon <span class="text-danger">*</span></label>
            <input id="keberatan-nama" name="nama" type="text" class="form-control custom-input"
                placeholder="Masukkan nama lengkap" value="<?= esc(old('nama', '')) ?>" required>
        </div>

        <div class="form-block">
            <label class="form-title">No. Identitas <span class="text-danger">*</span></label>
            <div class="form-grid-2">
                <select id="keberatan-jenis-identitas" name="identitas" class="form-select custom-input">
                    <?php
                    $identOld = old('identitas', 'KTP');
                    $identOpts = ['KTP', 'SIM', 'Paspor', 'Kartu Pelajar', 'Kartu Mahasiswa', 'Izin Usaha'];
                    ?>
                    <?php foreach ($identOpts as $opt) : ?>
                        <option value="<?= esc($opt) ?>" <?= $identOld === $opt ? 'selected' : '' ?>><?= esc(strtoupper($opt)) ?></option>
                    <?php endforeach; ?>
                </select>
                <input id="keberatan-nomor-identitas" name="nomor_identitas" type="text" class="form-control custom-input"
                    placeholder="Nomor identitas" value="<?= esc(old('nomor_identitas', '')) ?>" required>
            </div>
        </div>

        <div class="form-block">
            <label for="keberatan-alamat" class="form-title">Alamat <span class="text-danger">*</span></label>
            <textarea id="keberatan-alamat" name="alamat" rows="3" class="form-control custom-input"
                placeholder="Masukkan alamat lengkap" required><?= esc(old('alamat', '')) ?></textarea>
        </div>

        <div class="form-block">
            <label for="keberatan-telepon" class="form-title">Nomor Telepon/HP <span
                    class="text-danger">*</span></label>
            <input id="keberatan-telepon" name="telepon" type="tel" class="form-control custom-input"
                placeholder="08xxxxxxxxxx" value="<?= esc(old('telepon', '')) ?>" required>
        </div>

        <div class="form-block">
            <label for="keberatan-alasan" class="form-title">Alasan Mengajukan Keberatan <span
                    class="text-danger">*</span></label>
            <select id="keberatan-alasan" name="alasan" class="form-select custom-input" required>
                <option value="">Pilih alasan keberatan</option>
                <?php
                $alasanOld = old('alasan', '');
                $alasanOpts = \App\Models\InformationObjectionModel::reasonLabels();
                ?>
                <?php foreach ($alasanOpts as $val => $lbl) : ?>
                    <option value="<?= esc($val) ?>" <?= $alasanOld === $val ? 'selected' : '' ?>><?= esc($lbl) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-block">
            <label for="keberatan-kasus" class="form-title">Kasus Posisi <span class="text-danger">*</span></label>
            <textarea id="keberatan-kasus" name="kasus_posisi" rows="5" class="form-control custom-input"
                placeholder="Jelaskan kronologi dan alasan pengajuan keberatan secara detail" required><?= esc(old('kasus_posisi', '')) ?></textarea>
            <p class="field-help-text">
                Jelaskan secara rinci permohonan informasi yang diajukan, tanggapan yang diterima, dan mengapa Anda
                mengajukan keberatan.
            </p>
        </div>

        <div class="form-block">
            <label for="keberatan-registrasi" class="form-title">No. Registrasi Permohonan (jika ada)</label>
            <input id="keberatan-registrasi" name="no_registrasi_permohonan" type="text" class="form-control custom-input"
                placeholder="Contoh: PPID/2026/001" value="<?= esc(old('no_registrasi_permohonan', '')) ?>">
        </div>

        <div class="form-block">
            <label for="keberatan-lampiran" class="form-title">Lampiran Pendukung</label>
            <input id="keberatan-lampiran" name="lampiran" type="file" class="form-control custom-input file-upload-input">
            <p class="field-help-text">
                Upload dokumen pendukung seperti surat permohonan sebelumnya, surat tanggapan, atau bukti lainnya.
                Format: PDF, DOC, DOCX, JPG, PNG. Maks 10 MB.
            </p>
        </div>

        <div class="info-note-warning">
            <p>
                <strong>Catatan:</strong> Keberatan akan diproses maksimal 30 (tiga puluh) hari kerja sejak tanggal
                keberatan diterima. Anda akan menerima pemberitahuan mengenai status keberatan melalui telepon.
            </p>
        </div>

        <button type="submit" class="btn-submit">
            <i class="bi bi-send"></i>
            <span>Kirim Keberatan</span>
        </button>
    </form>
</div>
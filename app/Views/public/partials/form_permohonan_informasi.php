<div class="info-form-wrapper">
    <div class="info-form-toggle nav nav-pills" id="permohonan-tab" role="tablist">
        <button class="nav-link active" id="tab-permohonan" data-bs-toggle="pill" data-bs-target="#panel-permohonan"
            type="button" role="tab" aria-controls="panel-permohonan" aria-selected="true">
            Permohonan Informasi Publik
        </button>
        <button class="nav-link" id="tab-lacak" data-bs-toggle="pill" data-bs-target="#panel-lacak" type="button"
            role="tab" aria-controls="panel-lacak" aria-selected="false">
            Lacak Status Permohonan
        </button>
    </div>

    <div class="tab-content" id="permohonan-tab-content">
        <div class="tab-pane fade show active" id="panel-permohonan" role="tabpanel" aria-labelledby="tab-permohonan">
            <?php if (session()->getFlashdata('permohonan_success')) : ?>
                <div class="alert alert-success rounded-3 mt-3" role="alert">
                    <i class="bi bi-check-circle me-1"></i>
                    <?= esc(session()->getFlashdata('permohonan_success')) ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('permohonan_error')) : ?>
                <div class="alert alert-danger rounded-3 mt-3" role="alert">
                    <i class="bi bi-exclamation-triangle me-1"></i>
                    <?= esc(session()->getFlashdata('permohonan_error')) ?>
                </div>
            <?php endif; ?>

            <?php
            $errs = session()->getFlashdata('errors');
            if (is_array($errs) && $errs !== []) : ?>
                <div class="alert alert-danger rounded-3 mt-3">
                    <ul class="mb-0 ps-3">
                        <?php foreach ($errs as $err) : ?>
                            <li><?= esc(is_string($err) ? $err : (string) $err) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form class="info-form-layout" action="<?= base_url('layanan/form-permohonan-informasi/kirim') ?>" method="post">
                <?= csrf_field() ?>

                <div class="form-block">
                    <label class="form-title">Kategori Pemohon <span class="text-danger">*</span></label>
                    <div class="radio-inline-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="kategori" id="kategori-perorangan"
                                value="Perorangan" <?= old('kategori', 'Perorangan') === 'Perorangan' ? 'checked' : '' ?>>
                            <label class="form-check-label" for="kategori-perorangan">Perorangan</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="kategori" id="kategori-lembaga"
                                value="Lembaga" <?= old('kategori') === 'Lembaga' ? 'checked' : '' ?>>
                            <label class="form-check-label" for="kategori-lembaga">Lembaga</label>
                        </div>
                    </div>
                </div>

                <div class="form-block">
                    <label for="nama-pemohon" class="form-title">Nama Pemohon <span class="text-danger">*</span></label>
                    <input id="nama-pemohon" name="nama" type="text" class="form-control custom-input"
                        placeholder="Masukkan nama lengkap" value="<?= esc(old('nama', '')) ?>" required>
                </div>

                <div class="form-block">
                    <label for="pekerjaan" class="form-title">Pekerjaan <span class="text-danger">*</span></label>
                    <input id="pekerjaan" name="pekerjaan" type="text" class="form-control custom-input"
                        placeholder="Masukkan pekerjaan" value="<?= esc(old('pekerjaan', '')) ?>" required>
                </div>

                <div class="form-block">
                    <label for="alamat" class="form-title">Alamat <span class="text-danger">*</span></label>
                    <textarea id="alamat" name="alamat" rows="3" class="form-control custom-input"
                        placeholder="Masukkan alamat lengkap" required><?= esc(old('alamat', '')) ?></textarea>
                </div>

                <div class="form-block">
                    <label for="identitas" class="form-title">Identitas <span class="text-danger">*</span></label>
                    <select id="identitas" name="identitas" class="form-select custom-input">
                        <?php
                        $identOld = old('identitas', 'KTP');
                        $identOpts = ['KTP', 'SIM', 'Paspor', 'Kartu Pelajar', 'Kartu Mahasiswa', 'Izin Usaha'];
                        ?>
                        <?php foreach ($identOpts as $opt) : ?>
                            <option value="<?= esc($opt) ?>" <?= $identOld === $opt ? 'selected' : '' ?>><?= esc(strtoupper($opt)) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-block">
                    <label for="nomor-identitas" class="form-title">No. Identitas <span class="text-danger">*</span></label>
                    <input id="nomor-identitas" name="nomor_identitas" type="text" class="form-control custom-input"
                        placeholder="Masukkan nomor identitas" value="<?= esc(old('nomor_identitas', '')) ?>" required>
                </div>

                <div class="form-grid-2">
                    <div class="form-block">
                        <label for="telepon" class="form-title">Telepon <span class="text-danger">*</span></label>
                        <input id="telepon" name="telepon" type="tel" class="form-control custom-input"
                            placeholder="08xxxxxxxxxx" value="<?= esc(old('telepon', '')) ?>" required>
                    </div>
                    <div class="form-block">
                        <label for="email" class="form-title">Email <span class="text-danger">*</span></label>
                        <input id="email" name="email" type="email" class="form-control custom-input"
                            placeholder="email@example.com" value="<?= esc(old('email', '')) ?>" required>
                    </div>
                </div>

                <div class="form-block">
                    <label for="rincian-informasi" class="form-title">Rincian Informasi Yang Dibutuhkan <span
                            class="text-danger">*</span></label>
                    <textarea id="rincian-informasi" name="rincian_informasi" rows="4" class="form-control custom-input"
                        placeholder="Jelaskan secara detail informasi yang Anda butuhkan" required><?= esc(old('rincian_informasi', '')) ?></textarea>
                </div>

                <div class="form-block">
                    <label for="tujuan-informasi" class="form-title">Tujuan Penggunaan Informasi <span
                            class="text-danger">*</span></label>
                    <textarea id="tujuan-informasi" name="tujuan_informasi" rows="3" class="form-control custom-input"
                        placeholder="Jelaskan tujuan penggunaan informasi" required><?= esc(old('tujuan_informasi', '')) ?></textarea>
                </div>

                <div class="form-block">
                    <label for="cara-mendapatkan" class="form-title">Cara Mendapatkan Informasi <span
                            class="text-danger">*</span></label>
                    <select id="cara-mendapatkan" name="cara_mendapatkan" class="form-select custom-input">
                        <option value="membaca" <?= old('cara_mendapatkan') === 'membaca' ? 'selected' : '' ?>>Melihat/membaca/mendengarkan/mencatat</option>
                        <option value="salinan" <?= old('cara_mendapatkan') === 'salinan' ? 'selected' : '' ?>>Mendapatkan salinan informasi (hardcopy/softcopy)</option>
                    </select>
                </div>

                <div class="form-block">
                    <label for="cara-salinan" class="form-title">Cara Mendapatkan Salinan Informasi <span
                            class="text-danger">*</span></label>
                    <select id="cara-salinan" name="cara_salinan" class="form-select custom-input">
                        <?php
                        $salinanOld = old('cara_salinan', 'langsung');
                        $salinanOpts = ['langsung' => 'Mengambil Langsung', 'kurir' => 'Kurir', 'pos' => 'Pos', 'faksimili' => 'Faksimili', 'email' => 'Email'];
                        ?>
                        <?php foreach ($salinanOpts as $val => $lbl) : ?>
                            <option value="<?= esc($val) ?>" <?= $salinanOld === $val ? 'selected' : '' ?>><?= esc($lbl) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button type="submit" class="btn-submit">
                    <i class="bi bi-send"></i>
                    <span>Kirim Permohonan</span>
                </button>
            </form>
        </div>

        <div class="tab-pane fade" id="panel-lacak" role="tabpanel" aria-labelledby="tab-lacak">
            <form class="info-form-layout" action="<?= base_url('layanan/form-permohonan-informasi/lacak') ?>" method="post">
                <?= csrf_field() ?>
                <div class="form-block">
                    <label for="data-lacak" class="form-title">
                        No. Registrasi / No. Identitas / No. Telepon / Email <span class="text-danger">*</span>
                    </label>
                    <input id="data-lacak" name="query_lacak" type="text" class="form-control custom-input"
                        placeholder="Masukkan nomor registrasi, identitas, telepon, atau email"
                        value="<?= esc($trackQuery ?? '') ?>" required>
                    <p class="field-help-text">
                        Masukkan salah satu dari: No. Registrasi (PPID/2026/001), No. KTP/SIM/Paspor, No. Telepon, atau Email yang Anda gunakan saat
                        mengajukan permohonan.
                    </p>
                </div>

                <button type="submit" class="btn-submit">
                    <i class="bi bi-search"></i>
                    <span>Lacak Status</span>
                </button>
            </form>

            <?php if (isset($trackResults)) : ?>
                <div class="tracking-result-box">
                    <h3>Hasil Pencarian</h3>
                    <?php if ($trackResults === []) : ?>
                        <p class="text-secondary">Tidak ditemukan permohonan dengan data tersebut.</p>
                    <?php else : ?>
                        <?php foreach ($trackResults as $tr) : ?>
                            <div class="tracking-result-list mb-3">
                                <div class="tracking-item">
                                    <span class="tracking-label">No. Registrasi:</span>
                                    <span class="tracking-value"><?= esc((string) ($tr['registration_number'] ?? '')) ?></span>
                                </div>
                                <div class="tracking-item">
                                    <span class="tracking-label">Pemohon:</span>
                                    <span class="tracking-value"><?= esc((string) ($tr['name'] ?? '')) ?></span>
                                </div>
                                <div class="tracking-item">
                                    <span class="tracking-label">Tanggal Permohonan:</span>
                                    <span class="tracking-value"><?= esc(\App\Models\InformationRequestModel::displayDateFromRow($tr)) ?></span>
                                </div>
                                <div class="tracking-item">
                                    <span class="tracking-label">Status:</span>
                                    <span class="tracking-badge <?= \App\Models\InformationRequestModel::statusBadgeClass((string) ($tr['status'] ?? '')) ?>">
                                        <?= esc(\App\Models\InformationRequestModel::statusLabel((string) ($tr['status'] ?? ''))) ?>
                                    </span>
                                </div>
                                <?php if (trim((string) ($tr['admin_notes'] ?? '')) !== '') : ?>
                                    <div class="tracking-item">
                                        <span class="tracking-label">Catatan:</span>
                                        <span class="tracking-value"><?= esc((string) $tr['admin_notes']) ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
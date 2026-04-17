<div class="info-form-wrapper">
    <div class="info-form-toggle nav nav-pills" id="permohonan-tab" role="tablist">
        <button
            class="nav-link active"
            id="tab-permohonan"
            data-bs-toggle="pill"
            data-bs-target="#panel-permohonan"
            type="button"
            role="tab"
            aria-controls="panel-permohonan"
            aria-selected="true">
            Permohonan Informasi Publik
        </button>
        <button
            class="nav-link"
            id="tab-lacak"
            data-bs-toggle="pill"
            data-bs-target="#panel-lacak"
            type="button"
            role="tab"
            aria-controls="panel-lacak"
            aria-selected="false">
            Lacak Status Permohonan
        </button>
    </div>

    <div class="tab-content" id="permohonan-tab-content">
        <div class="tab-pane fade show active" id="panel-permohonan" role="tabpanel" aria-labelledby="tab-permohonan">
            <form class="info-form-layout" action="#" method="post">
                <div class="form-block">
                    <label class="form-title">Kategori Pemohon <span class="text-danger">*</span></label>
                    <div class="radio-inline-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="kategori" id="kategori-perorangan" value="Perorangan" checked>
                            <label class="form-check-label" for="kategori-perorangan">Perorangan</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="kategori" id="kategori-lembaga" value="Lembaga">
                            <label class="form-check-label" for="kategori-lembaga">Lembaga</label>
                        </div>
                    </div>
                </div>

                <div class="form-block">
                    <label for="nama-pemohon" class="form-title">Nama Pemohon <span class="text-danger">*</span></label>
                    <input id="nama-pemohon" type="text" class="form-control custom-input" placeholder="Masukkan nama lengkap">
                </div>

                <div class="form-block">
                    <label for="pekerjaan" class="form-title">Pekerjaan <span class="text-danger">*</span></label>
                    <input id="pekerjaan" type="text" class="form-control custom-input" placeholder="Masukkan pekerjaan">
                </div>

                <div class="form-block">
                    <label for="alamat" class="form-title">Alamat <span class="text-danger">*</span></label>
                    <textarea id="alamat" rows="3" class="form-control custom-input" placeholder="Masukkan alamat lengkap"></textarea>
                </div>

                <div class="form-block">
                    <label for="identitas" class="form-title">Identitas <span class="text-danger">*</span></label>
                    <select id="identitas" class="form-select custom-input">
                        <option value="KTP">KTP</option>
                        <option value="SIM">SIM</option>
                        <option value="Paspor">PASPOR</option>
                        <option value="Kartu Pelajar">KARTU PELAJAR</option>
                        <option value="Kartu Mahasiswa">KARTU MAHASISWA</option>
                        <option value="Izin Usaha">IZIN USAHA</option>
                    </select>
                </div>

                <div class="form-block">
                    <label for="nomor-identitas" class="form-title">No. Identitas <span class="text-danger">*</span></label>
                    <input id="nomor-identitas" type="text" class="form-control custom-input" placeholder="Masukkan nomor identitas">
                </div>

                <div class="form-grid-2">
                    <div class="form-block">
                        <label for="telepon" class="form-title">Telepon <span class="text-danger">*</span></label>
                        <input id="telepon" type="tel" class="form-control custom-input" placeholder="08xxxxxxxxxx">
                    </div>
                    <div class="form-block">
                        <label for="email" class="form-title">Email <span class="text-danger">*</span></label>
                        <input id="email" type="email" class="form-control custom-input" placeholder="email@example.com">
                    </div>
                </div>

                <div class="form-block">
                    <label for="rincian-informasi" class="form-title">Rincian Informasi Yang Dibutuhkan <span class="text-danger">*</span></label>
                    <textarea id="rincian-informasi" rows="4" class="form-control custom-input" placeholder="Jelaskan secara detail informasi yang Anda butuhkan"></textarea>
                </div>

                <div class="form-block">
                    <label for="tujuan-informasi" class="form-title">Tujuan Penggunaan Informasi <span class="text-danger">*</span></label>
                    <textarea id="tujuan-informasi" rows="3" class="form-control custom-input" placeholder="Jelaskan tujuan penggunaan informasi"></textarea>
                </div>

                <div class="form-block">
                    <label for="cara-mendapatkan" class="form-title">Cara Mendapatkan Informasi <span class="text-danger">*</span></label>
                    <select id="cara-mendapatkan" class="form-select custom-input">
                        <option value="membaca">Melihat/membaca/mendengarkan/mencatat</option>
                        <option value="salinan">Mendapatkan salinan informasi (hardcopy/softcopy)</option>
                    </select>
                </div>

                <div class="form-block">
                    <label for="cara-salinan" class="form-title">Cara Mendapatkan Salinan Informasi <span class="text-danger">*</span></label>
                    <select id="cara-salinan" class="form-select custom-input">
                        <option value="langsung">Mengambil Langsung</option>
                        <option value="kurir">Kurir</option>
                        <option value="pos">Pos</option>
                        <option value="faksimili">Faksimili</option>
                        <option value="email">Email</option>
                    </select>
                </div>

                <button type="submit" class="btn-submit">
                    <i class="bi bi-send"></i>
                    <span>Kirim Permohonan</span>
                </button>
            </form>
        </div>

        <div class="tab-pane fade" id="panel-lacak" role="tabpanel" aria-labelledby="tab-lacak">
            <form class="info-form-layout" action="#" method="post">
                <div class="form-block">
                    <label for="data-lacak" class="form-title">
                        No. Identitas / No. Telepon / Email <span class="text-danger">*</span>
                    </label>
                    <input id="data-lacak" type="text" class="form-control custom-input" placeholder="Masukkan nomor identitas, telepon, atau email yang didaftarkan">
                    <p class="field-help-text">
                        Masukkan salah satu dari: No. KTP/SIM/Paspor, No. Telepon, atau Email yang Anda gunakan saat mengajukan permohonan.
                    </p>
                </div>

                <button type="submit" class="btn-submit">
                    <i class="bi bi-search"></i>
                    <span>Lacak Status</span>
                </button>
            </form>

            <div class="tracking-result-box">
                <h3>Hasil Pencarian</h3>
                <div class="tracking-result-list">
                    <div class="tracking-item">
                        <span class="tracking-label">No. Registrasi:</span>
                        <span class="tracking-value">PPID/2026/001</span>
                    </div>
                    <div class="tracking-item">
                        <span class="tracking-label">Tanggal Permohonan:</span>
                        <span class="tracking-value">5 April 2026</span>
                    </div>
                    <div class="tracking-item">
                        <span class="tracking-label">Status:</span>
                        <span class="tracking-badge">Diproses</span>
                    </div>
                    <div class="tracking-item">
                        <span class="tracking-label">Estimasi Selesai:</span>
                        <span class="tracking-value">15 April 2026</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

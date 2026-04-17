<div class="info-form-wrapper">
    <form class="info-form-layout" action="#" method="post" enctype="multipart/form-data">
        <div class="form-block">
            <label for="keberatan-nama" class="form-title">Nama Pemohon <span class="text-danger">*</span></label>
            <input id="keberatan-nama" type="text" class="form-control custom-input" placeholder="Masukkan nama lengkap">
        </div>

        <div class="form-block">
            <label class="form-title">No. Identitas <span class="text-danger">*</span></label>
            <div class="form-grid-2">
                <select id="keberatan-jenis-identitas" class="form-select custom-input">
                    <option value="KTP">KTP</option>
                    <option value="SIM">SIM</option>
                    <option value="Paspor">PASPOR</option>
                    <option value="Kartu Pelajar">KARTU PELAJAR</option>
                    <option value="Kartu Mahasiswa">KARTU MAHASISWA</option>
                    <option value="Izin Usaha">IZIN USAHA</option>
                </select>
                <input id="keberatan-nomor-identitas" type="text" class="form-control custom-input" placeholder="Nomor identitas">
            </div>
        </div>

        <div class="form-block">
            <label for="keberatan-alamat" class="form-title">Alamat <span class="text-danger">*</span></label>
            <textarea id="keberatan-alamat" rows="3" class="form-control custom-input" placeholder="Masukkan alamat lengkap"></textarea>
        </div>

        <div class="form-block">
            <label for="keberatan-telepon" class="form-title">Nomor Telepon/HP <span class="text-danger">*</span></label>
            <input id="keberatan-telepon" type="tel" class="form-control custom-input" placeholder="08xxxxxxxxxx">
        </div>

        <div class="form-block">
            <label for="keberatan-alasan" class="form-title">Alasan Mengajukan Keberatan <span class="text-danger">*</span></label>
            <select id="keberatan-alasan" class="form-select custom-input">
                <option value="">Pilih alasan keberatan</option>
                <option value="ditolak">Permohonan Informasi Ditolak</option>
                <option value="tidak-ditanggapi">Permintaan Informasi Tidak Ditanggapi</option>
                <option value="tidak-sesuai">Permintaan Informasi Ditanggapi Tidak Sebagaimana Yang Diminta</option>
                <option value="tidak-dipenuhi">Permintaan Informasi Tidak Dipenuhi</option>
                <option value="melebihi-waktu">Informasi Yang Disampaikan Melebihi Jangka Waktu Yang Ditentukan</option>
                <option value="biaya-tidak-wajar">Biaya Yang Dikenakan Tidak Wajar</option>
                <option value="informasi-berkala">Informasi Berkala Tidak Disediakan</option>
            </select>
        </div>

        <div class="form-block">
            <label for="keberatan-kasus" class="form-title">Kasus Posisi <span class="text-danger">*</span></label>
            <textarea
                id="keberatan-kasus"
                rows="5"
                class="form-control custom-input"
                placeholder="Jelaskan kronologi dan alasan pengajuan keberatan secara detail"></textarea>
            <p class="field-help-text">
                Jelaskan secara rinci permohonan informasi yang diajukan, tanggapan yang diterima, dan mengapa Anda mengajukan keberatan.
            </p>
        </div>

        <div class="form-block">
            <label for="keberatan-registrasi" class="form-title">No. Registrasi Permohonan (jika ada)</label>
            <input id="keberatan-registrasi" type="text" class="form-control custom-input" placeholder="Contoh: PPID/2026/001">
        </div>

        <div class="form-block">
            <label for="keberatan-lampiran" class="form-title">Lampiran Pendukung</label>
            <input id="keberatan-lampiran" type="file" multiple class="form-control custom-input file-upload-input">
            <p class="field-help-text">
                Upload dokumen pendukung seperti surat permohonan sebelumnya, surat tanggapan, atau bukti lainnya.
            </p>
        </div>

        <div class="info-note-warning">
            <p>
                <strong>Catatan:</strong> Keberatan akan diproses maksimal 30 (tiga puluh) hari kerja sejak tanggal
                keberatan diterima. Anda akan menerima pemberitahuan mengenai status keberatan melalui email atau telepon.
            </p>
        </div>

        <button type="submit" class="btn-submit">
            <i class="bi bi-send"></i>
            <span>Kirim Keberatan</span>
        </button>
    </form>
</div>

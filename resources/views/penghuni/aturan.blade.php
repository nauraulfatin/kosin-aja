@extends('layouts.sidebar')

@section('title', 'Aturan Kos - KosinAja!')

@section('styles')
<style>
.page-title {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-weight: 800;
    font-size: 1.3rem;
    color: var(--text-dark);
    margin-bottom: 20px
}

.grid-2 {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px
}

.form-group {
    margin-bottom: 16px
}

.form-label {
    font-size: 0.82rem;
    font-weight: 600;
    color: var(--text-mid);
    margin-bottom: 6px;
    display: block
}

.form-value {
    font-size: 0.9rem;
    color: var(--text-dark);
    font-weight: 500;
    padding: 10px 14px;
    background: #f8faf8;
    border: 1px solid var(--border);
    border-radius: 10px
}

.upload-area {
    border: 2px dashed var(--border);
    border-radius: 12px;
    padding: 32px;
    text-align: center;
    cursor: pointer;
    transition: border-color 0.2s;
    position: relative
}

.upload-area:hover {
    border-color: var(--cta)
}

.upload-area input[type=file] {
    position: absolute;
    inset: 0;
    opacity: 0;
    cursor: pointer
}

.upload-icon {
    margin: 0 auto 8px;
    width: 40px;
    height: 40px;
    background: #f0f5f1;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center
}

.upload-icon svg {
    width: 20px;
    height: 20px;
    fill: var(--cta)
}

.upload-text {
    font-size: 0.82rem;
    color: var(--text-light)
}

.btn-submit {
    width: 100%;
    padding: 12px;
    background: var(--cta);
    color: #fff;
    border: none;
    border-radius: 10px;
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-weight: 700;
    font-size: 0.9rem;
    cursor: pointer;
    transition: background 0.2s;
    margin-top: 8px
}

.btn-submit:hover {
    background: var(--cta-hover)
}

.aturan-list {
    display: flex;
    flex-direction: column;
    gap: 0
}

.aturan-item {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 12px 0;
    border-bottom: 1px solid var(--border)
}

.aturan-item:last-child {
    border-bottom: none
}

.aturan-num {
    width: 24px;
    height: 24px;
    min-width: 24px;
    background: var(--cta);
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.75rem;
    font-weight: 700;
    color: #fff;
    margin-top: 1px
}

.aturan-text {
    font-size: 0.85rem;
    color: var(--text-mid);
    line-height: 1.5
}
</style>
@endsection

@section('content')
<p class="page-title">Aturan Kos</p>

<div class="grid-2">
    {{-- Upload Bukti Persetujuan --}}
    <div class="card">
        <div
            style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:0.95rem;color:var(--text-dark);margin-bottom:4px;">
            Bukti Persetujuan</div>
        <div style="font-size:0.8rem;color:var(--text-light);margin-bottom:20px;">Upload tanda tangan persetujuan aturan
            kos.</div>

        <form>
            <div class="form-group">
                <label class="form-label">Tagihan bulan ini</label>
                <div class="form-value">Rp 500.000</div>
            </div>
            <div class="form-group">
                <label class="form-label">ID Tagihan</label>
                <div class="form-value">#TAG-2026-05</div>
            </div>
            <div class="form-group">
                <label class="form-label">Periode</label>
                <div class="form-value">Mei 2026</div>
            </div>
            <div class="form-group">
                <label class="form-label">Foto</label>
                <div class="upload-area">
                    <input type="file" accept="image/*">
                    <div class="upload-icon">
                        <svg viewBox="0 0 24 24">
                            <path
                                d="M19.35 10.04A7.49 7.49 0 0012 4C9.11 4 6.6 5.64 5.35 8.04A5.994 5.994 0 000 14c0 3.31 2.69 6 6 6h13c2.76 0 5-2.24 5-5 0-2.64-2.05-4.78-4.65-4.96zM14 13v4h-4v-4H7l5-5 5 5h-3z" />
                        </svg>
                    </div>
                    <div class="upload-text">Upload Foto</div>
                </div>
            </div>
            <button type="button" class="btn-submit">Kirim Bukti</button>
        </form>
    </div>

    {{-- Daftar Aturan --}}
    <div class="card">
        <div
            style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:0.95rem;color:var(--text-dark);margin-bottom:16px;">
            Daftar Aturan Kos</div>
        <div class="aturan-list">
            <div class="aturan-item">
                <div class="aturan-num">1</div>
                <div class="aturan-text">Bayar sewa tepat waktu setiap tanggal 1 setiap bulannya.</div>
            </div>
            <div class="aturan-item">
                <div class="aturan-num">2</div>
                <div class="aturan-text">Tidak diperbolehkan membawa tamu menginap tanpa izin pengelola.</div>
            </div>
            <div class="aturan-item">
                <div class="aturan-num">3</div>
                <div class="aturan-text">Jaga kebersihan kamar dan area bersama setiap saat.</div>
            </div>
            <div class="aturan-item">
                <div class="aturan-num">4</div>
                <div class="aturan-text">Tidak membuat keributan yang mengganggu penghuni lain.</div>
            </div>
            <div class="aturan-item">
                <div class="aturan-num">5</div>
                <div class="aturan-text">Pintu gerbang dikunci pukul 22.00 WIB setiap malam.</div>
            </div>
            <div class="aturan-item">
                <div class="aturan-num">6</div>
                <div class="aturan-text">Kerusakan fasilitas akibat kelalaian penghuni menjadi tanggung jawab penghuni.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
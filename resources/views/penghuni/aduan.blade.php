@extends('layouts.sidebar')

@section('title', 'Aduan - KosinAja!')

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

.form-input {
    width: 100%;
    padding: 11px 14px;
    border: 1.5px solid var(--border);
    border-radius: 10px;
    background: var(--bg);
    font-family: 'DM Sans', sans-serif;
    font-size: 0.88rem;
    color: var(--text-dark);
    outline: none;
    transition: border-color 0.2s;
    resize: none
}

.form-input:focus {
    border-color: var(--cta)
}

.form-input::placeholder {
    color: var(--text-light)
}

textarea.form-input {
    height: 120px
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

.aduan-list {
    display: flex;
    flex-direction: column;
    gap: 0
}

.aduan-item {
    padding: 14px 0;
    border-bottom: 1px solid var(--border)
}

.aduan-item:last-child {
    border-bottom: none
}

.aduan-row {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 12px
}

.aduan-title {
    font-size: 0.88rem;
    font-weight: 600;
    color: var(--text-dark);
    margin-bottom: 3px
}

.aduan-date {
    font-size: 0.75rem;
    color: var(--text-light)
}

.badge {
    display: inline-flex;
    align-items: center;
    padding: 3px 10px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600
}

.badge-success {
    background: #e8f5e9;
    color: #2e7d32
}

.badge-warning {
    background: #fff8e1;
    color: #f57f17
}

.badge-danger {
    background: #ffebee;
    color: #c62828
}
</style>
@endsection

@section('content')
<p class="page-title">Aduan</p>

<div class="grid-2">
    {{-- Form Aduan --}}
    <div class="card">
        <div
            style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:0.95rem;color:var(--text-dark);margin-bottom:20px;">
            Buat Aduan (Penghuni)</div>

        <form>
            <div class="form-group">
                <label class="form-label">Isi Aduan</label>
                <textarea class="form-input" placeholder="Tuliskan aduan kamu..."></textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Foto (opsional)</label>
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

            <button type="button" class="btn-submit">Kirim Aduan</button>
        </form>
    </div>

    {{-- Riwayat Aduan --}}
    <div class="card">
        <div
            style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:0.95rem;color:var(--text-dark);margin-bottom:16px;">
            Riwayat Aduan</div>

        <div class="aduan-list">
            <div class="aduan-item">
                <div class="aduan-row">
                    <div>
                        <div class="aduan-title">Lampu kamar mati sejak kemarin malam.</div>
                        <div class="aduan-date">02 Mei 2026</div>
                    </div>
                    <span class="badge badge-warning">Diproses</span>
                </div>
            </div>

            <div class="aduan-item">
                <div class="aduan-row">
                    <div>
                        <div class="aduan-title">Kran kamar mandi bocor.</div>
                        <div class="aduan-date">28 Apr 2026</div>
                    </div>
                    <span class="badge badge-success">Selesai</span>
                </div>
            </div>

            <div class="aduan-item">
                <div class="aduan-row">
                    <div>
                        <div class="aduan-title">WiFi lantai 2 sering putus.</div>
                        <div class="aduan-date">20 Apr 2026</div>
                    </div>
                    <span class="badge badge-danger">Menunggu</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
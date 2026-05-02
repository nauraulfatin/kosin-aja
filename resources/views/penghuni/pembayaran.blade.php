@extends('layouts.sidebar')

@section('title', 'Pembayaran - KosinAja!')

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

.riwayat-table {
    width: 100%;
    border-collapse: collapse
}

.riwayat-table th {
    font-size: 0.75rem;
    color: var(--text-light);
    font-weight: 600;
    padding: 0 0 10px;
    text-align: left;
    border-bottom: 1px solid var(--border)
}

.riwayat-table td {
    font-size: 0.83rem;
    color: var(--text-mid);
    padding: 12px 0;
    border-bottom: 1px solid var(--border)
}

.riwayat-table tr:last-child td {
    border-bottom: none
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
<p class="page-title">Pembayaran</p>

<div class="grid-2">
    {{-- Form Upload Bukti --}}
    <div class="card">
        <div
            style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:0.95rem;color:var(--text-dark);margin-bottom:4px;">
            Bukti Pembayaran</div>
        <div style="font-size:0.8rem;color:var(--text-light);margin-bottom:20px;">Cukup kirim bukti pembayaran aja.
        </div>

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

    {{-- Riwayat --}}
    <div class="card">
        <div
            style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:0.95rem;color:var(--text-dark);margin-bottom:20px;">
            Riwayat Pembayaran</div>

        <table class="riwayat-table">
            <thead>
                <tr>
                    <th>Bulan</th>
                    <th>Nominal</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Mei 2026</td>
                    <td>Rp 500.000</td>
                    <td><span class="badge badge-warning">Menunggu</span></td>
                </tr>
                <tr>
                    <td>April 2026</td>
                    <td>Rp 400.000</td>
                    <td><span class="badge badge-success">Lunas</span></td>
                </tr>
                <tr>
                    <td>Maret 2026</td>
                    <td>Rp 400.000</td>
                    <td><span class="badge badge-success">Lunas</span></td>
                </tr>
                <tr>
                    <td>Feb 2026</td>
                    <td>Rp 400.000</td>
                    <td><span class="badge badge-success">Lunas</span></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
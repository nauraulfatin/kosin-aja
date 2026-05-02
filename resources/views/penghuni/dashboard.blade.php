@extends('layouts.sidebar')

@section('title', 'Dashboard - KosinAja!')

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
    gap: 16px;
    margin-bottom: 16px
}

.grid-3 {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
    margin-bottom: 16px
}

.stat-label {
    font-size: 0.78rem;
    color: var(--text-light);
    margin-bottom: 4px
}

.stat-value {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-weight: 700;
    font-size: 1.05rem;
    color: var(--text-dark)
}

.stat-sub {
    font-size: 0.78rem;
    color: var(--text-light);
    margin-top: 2px
}

.btn-sm {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 14px;
    border-radius: 8px;
    font-size: 0.8rem;
    font-weight: 600;
    cursor: pointer;
    border: none;
    text-decoration: none;
    transition: all 0.2s
}

.btn-sm-primary {
    background: var(--cta);
    color: #fff
}

.btn-sm-primary:hover {
    background: var(--cta-hover)
}

.card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 16px
}

.card-header-title {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-weight: 700;
    font-size: 0.95rem;
    color: var(--text-dark)
}

.riwayat-table {
    width: 100%;
    border-collapse: collapse
}

.riwayat-table th {
    font-size: 0.75rem;
    color: var(--text-light);
    font-weight: 600;
    padding: 0 0 8px;
    text-align: left;
    border-bottom: 1px solid var(--border)
}

.riwayat-table td {
    font-size: 0.82rem;
    color: var(--text-mid);
    padding: 10px 0;
    border-bottom: 1px solid var(--border)
}

.riwayat-table tr:last-child td {
    border-bottom: none
}

.link-lihat {
    font-size: 0.78rem;
    color: var(--cta);
    font-weight: 600;
    text-decoration: none
}

.aduan-item {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 12px;
    padding: 12px 0;
    border-bottom: 1px solid var(--border)
}

.aduan-item:last-child {
    border-bottom: none
}

.aduan-title {
    font-size: 0.85rem;
    font-weight: 600;
    color: var(--text-dark);
    margin-bottom: 2px
}

.aduan-date {
    font-size: 0.75rem;
    color: var(--text-light)
}
</style>
@endsection

@section('content')
<p class="page-title">Selamat datang, Shavira</p>

<div class="grid-2">
    {{-- Status Kamar --}}
    <div class="card">
        <div class="card-header">
            <span class="card-header-title">Status Kamar</span>
        </div>
        <div class="stat-label">Kos Kamu Kini</div>
        <div class="stat-value">Melati Residence</div>
        <div class="stat-sub">No. Kamar: A12</div>
        <div style="margin-top:12px;">
            <span class="badge badge-success">Aktif</span>
        </div>
    </div>

    {{-- Tagihan Bulan Ini --}}
    <div class="card">
        <div class="card-header">
            <span class="card-header-title">Tagihan Bulan Ini</span>
        </div>
        <div class="stat-label">Total tagihan</div>
        <div class="stat-value">Rp 500.000</div>
        <div class="stat-sub">Jatuh tempo: 1 Ags 2026</div>
        <div style="margin-top:12px;">
            <button class="btn-sm btn-sm-primary">Bayar Sekarang</button>
        </div>
    </div>
</div>

<div class="grid-2">
    {{-- Riwayat Pembayaran --}}
    <div class="card">
        <div class="card-header">
            <span class="card-header-title">Riwayat Terakhir</span>
            <a href="#" class="link-lihat">Lihat semua</a>
        </div>
        <table class="riwayat-table">
            <thead>
                <tr>
                    <th>Bulan</th>
                    <th>Nominal</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>April 2026</td>
                    <td>Rp 400.000</td>
                    <td><span class="badge badge-success">Lunas</span></td>
                    <td><a href="#" class="link-lihat">Lihat</a></td>
                </tr>
                <tr>
                    <td>Maret 2026</td>
                    <td>Rp 400.000</td>
                    <td><span class="badge badge-success">Lunas</span></td>
                    <td><a href="#" class="link-lihat">Lihat</a></td>
                </tr>
                <tr>
                    <td>Feb 2026</td>
                    <td>Rp 400.000</td>
                    <td><span class="badge badge-success">Lunas</span></td>
                    <td><a href="#" class="link-lihat">Lihat</a></td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- Aduan Terbaru --}}
    <div class="card">
        <div class="card-header">
            <span class="card-header-title">Aduan Terbaru</span>
            <a href="#" class="link-lihat">Lihat semua</a>
        </div>

        <div class="aduan-item">
            <div>
                <div class="aduan-title">AC bocor di kamar</div>
                <div class="aduan-date">2 Mei 2026</div>
            </div>
            <span class="badge badge-warning">Diproses</span>
        </div>

        <div class="aduan-item">
            <div>
                <div class="aduan-title">Lampu kamar mandi mati</div>
                <div class="aduan-date">20 Apr 2026</div>
            </div>
            <span class="badge badge-success">Selesai</span>
        </div>
    </div>
</div>
@endsection
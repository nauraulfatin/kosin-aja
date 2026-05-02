@extends('layouts.sidebar')

@section('title', 'Profil - KosinAja!')

@section('styles')
<style>
.page-title {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-weight: 800;
    font-size: 1.3rem;
    color: var(--text-dark);
    margin-bottom: 20px
}

.profil-wrap {
    max-width: 560px
}

.profil-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 12px 0;
    border-bottom: 1px solid var(--border)
}

.profil-row:last-of-type {
    border-bottom: none
}

.profil-key {
    font-size: 0.82rem;
    color: var(--text-light);
    font-weight: 500;
    min-width: 120px
}

.profil-val {
    font-size: 0.88rem;
    color: var(--text-dark);
    font-weight: 500;
    text-align: right
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

.btn-row {
    display: flex;
    gap: 12px;
    margin-top: 20px
}

.btn-edit {
    padding: 10px 24px;
    background: var(--cta);
    color: #fff;
    border: none;
    border-radius: 10px;
    font-family: 'DM Sans', sans-serif;
    font-weight: 600;
    font-size: 0.88rem;
    cursor: pointer;
    text-decoration: none;
    transition: background 0.2s
}

.btn-edit:hover {
    background: var(--cta-hover)
}

.btn-keluar {
    padding: 10px 24px;
    background: #ffebee;
    color: #c62828;
    border: none;
    border-radius: 10px;
    font-family: 'DM Sans', sans-serif;
    font-weight: 600;
    font-size: 0.88rem;
    cursor: pointer;
    transition: background 0.2s
}

.btn-keluar:hover {
    background: #ffcdd2
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
    transition: border-color 0.2s
}

.form-input:focus {
    border-color: var(--cta)
}
</style>
@endsection

@section('content')
<p class="page-title">Profil</p>

<div class="card profil-wrap">
    <div
        style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:0.95rem;color:var(--text-dark);margin-bottom:16px;">
        Profil Penghuni</div>

    {{-- Tampilan Profil --}}
    <div class="profil-row">
        <span class="profil-key">Nama</span>
        <span class="profil-val">Shavira Nindya</span>
    </div>

    <div class="profil-row">
        <span class="profil-key">No. Kamar</span>
        <span class="profil-val">A12</span>
    </div>

    <div class="profil-row">
        <span class="profil-key">No. Telp</span>
        <span class="profil-val">0812-3456-7890</span>
    </div>

    <div class="profil-row">
        <span class="profil-key">Tanggal Masuk</span>
        <span class="profil-val">01 Jan 2026</span>
    </div>

    <div class="profil-row">
        <span class="profil-key">Status</span>
        <span class="profil-val"><span class="badge badge-success">Aktif</span></span>
    </div>

    <div class="btn-row">
        <button type="button" class="btn-edit">Edit Profil</button>
        <button type="button" class="btn-keluar">Keluar</button>
    </div>
</div>
@endsection
@extends('layouts.app')
@section('title', 'Tambah Staff')
@section('content')
<div class="card border-0 shadow-sm col-md-6">
    <div class="card-header bg-white py-3"><h5 class="mb-0 fw-bold">Tambah Akun Staff Baru</h5></div>
    <div class="card-body">
        <form action="{{ route('staff.users.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="name" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email <span class="text-danger">*</span></label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="mb-4">
                <label class="form-label">Password <span class="text-danger">*</span></label>
                <input type="password" class="form-control" name="password" required minlength="6">
            </div>
            <button type="submit" class="btn btn-primary w-100">Buat Akun Staff</button>
        </form>
    </div>
</div>
@endsection

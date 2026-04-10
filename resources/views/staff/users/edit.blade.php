@extends('layouts.app')
@section('title', 'Edit Staff')
@section('content')
<div class="card border-0 shadow-sm col-md-6">
    <div class="card-header bg-white py-3"><h5 class="mb-0 fw-bold">Edit Akun: {{ $user->name }}</h5></div>
    <div class="card-body">
        <form action="{{ route('staff.users.update', $user->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="name" value="{{ $user->name }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email <span class="text-danger">*</span></label>
                <input type="email" class="form-control" name="email" value="{{ $user->email }}" required>
            </div>
            <hr>
            <div class="mb-4">
                <label class="fw-bold text-danger">Ubah Password (Opsional)</label>
                <input type="password" class="form-control" name="new_password" placeholder="Kosongkan jika tidak diganti">
            </div>
            <button type="submit" class="btn btn-warning w-100">Simpan Perubahan</button>
        </form>
    </div>
</div>
@endsection

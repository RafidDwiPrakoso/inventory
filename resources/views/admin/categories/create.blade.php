@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('content')
<div class="card border-0 shadow-sm col-md-6">
    <div class="card-header bg-white py-3">
        <h5 class="mb-0 fw-bold">Tambah Kategori Baru</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nama Kategori <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="name" required>
            </div>
            <div class="mb-4">
                <label class="form-label">Divisi Penanggung Jawab <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="division" placeholder="Contoh: IT Support, Sarpras, dll" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Simpan Kategori</button>
        </form>
    </div>
</div>
@endsection

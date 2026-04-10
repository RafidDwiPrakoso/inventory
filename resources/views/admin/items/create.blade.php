@extends('layouts.app')
@section('title', 'Tambah Barang')
@section('content')
<div class="card border-0 shadow-sm col-md-6">
    <div class="card-header bg-white py-3"><h5 class="mb-0 fw-bold">Tambah Barang Baru</h5></div>
    <div class="card-body">
        <form action="{{ route('admin.items.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Kategori <span class="text-danger">*</span></label>
                <select class="form-select" name="category_id" required>
                    <option value="" disabled selected>-- Pilih Kategori --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }} ({{ $category->division }})</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Barang <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="item_name" required>
            </div>

            <div class="mb-4">
                <label class="form-label">Total Fisik Stok <span class="text-danger">*</span></label>
                <input type="number" min="1" class="form-control" name="total_stock" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Simpan Barang</button>
        </form>
    </div>
</div>
@endsection

@extends('layouts.app')
@section('title', 'Edit Barang')
@section('content')
<div class="card border-0 shadow-sm col-md-6">
    <div class="card-header bg-white py-3"><h5 class="mb-0 fw-bold">Edit Barang: {{ $item->item_name }}</h5></div>
    <div class="card-body">
        <form action="{{ route('admin.items.update', $item->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Kategori <span class="text-danger">*</span></label>
                <select class="form-select" name="category_id" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $item->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }} ({{ $category->division }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Barang <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="item_name" value="{{ old('item_name', $item->item_name) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Total Fisik <span class="text-danger">*</span></label>
                <input type="number" min="1" class="form-control @error('total_stock') is-invalid @enderror" name="total_stock" value="{{ old('total_stock', $item->total_stock) }}" required>
                @error('total_stock') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
            </div>

            <hr>

            <div class="mb-4 p-3 bg-light rounded border">
                <label class="form-label fw-bold text-danger">Barang Rusak Tambahan</label>
                <div class="input-group has-validation">
                    <input type="number" min="0" class="form-control @error('new_broke_item') is-invalid @enderror" name="new_broke_item" value="0">
                    <span class="input-group-text bg-white text-muted">
                        Sedang Rusak: {{ $item->total_repaired }}
                    </span>
                    @error('new_broke_item') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                </div>
                <small class="text-muted">Isi angka jika ada tambahan barang yang rusak.</small>
            </div>

            <button type="submit" class="btn btn-warning w-100">Update Barang</button>
        </form>
    </div>
</div>
@endsection

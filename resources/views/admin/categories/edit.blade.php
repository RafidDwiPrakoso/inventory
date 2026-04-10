@extends('layouts.app')

@section('title', 'Edit Kategori')

@section('content')
<div class="card border-0 shadow-sm col-md-6">
    <div class="card-header bg-white py-3">
        <h5 class="mb-0 fw-bold">Edit Kategori: {{ $category->name }}</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Nama Kategori <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="name" value="{{ old('name', $category->name) }}" required>
            </div>
            <div class="mb-4">
                <label class="form-label">Divisi Penanggung Jawab <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="division" value="{{ old('division', $category->division) }}" required>
            </div>
            <button type="submit" class="btn btn-warning w-100">Update Kategori</button>
        </form>
    </div>
</div>
@endsection

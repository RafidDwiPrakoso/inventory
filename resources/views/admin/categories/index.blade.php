@extends('layouts.app')

@section('title', 'Kelola Kategori')

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
            <h5 class="mb-0 fw-bold">Data Kategori Barang</h5>
            <div>
                <a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-circle"></i> Tambah Kategori
                </a>
                <a href="{{ url('admin/categories/export') }}" class="btn btn-success btn-sm">
                    <i class="bi bi-file-earmark-excel"></i> Export Excel
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama Kategori</th>
                            <th>Divisi Penanggung Jawab</th>
                            <th class="text-center">Total Barang</th>
                            <th width="15%" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $index => $category)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->division }}</td>
                                <td class="text-center">
                                    <span class="badge bg-secondary">{{ $category->item_stocks_count }} Barang</span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('admin.categories.edit', $category->id) }}"
                                        class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">Belum ada data kategori.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

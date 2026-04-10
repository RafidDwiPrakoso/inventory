@extends('layouts.app')
@section('title', 'Kelola Barang')
@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h5 class="mb-0 fw-bold">Data Master Items</h5>
        <a href="{{ route('admin.items.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle"></i> Tambah Item
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="5%">No</th>
                        <th>Category</th>
                        <th>Nama Barang</th>
                        <th class="text-center">Total Fisik</th>
                        <th class="text-center text-success">Tersedia</th>
                        <th class="text-center text-danger">Rusak</th>
                        <th class="text-center text-primary">Dipinjam</th>
                        <th width="15%" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->category->name ?? '-' }}</td>
                        <td>{{ $item->item_name }}</td>
                        <td class="text-center fw-bold">{{ $item->total_stock }}</td>

                        <td class="text-center fw-bold text-success">{{ $item->available }}</td>

                        <td class="text-center text-danger">{{ $item->total_repaired }}</td>

                        <td class="text-center">
                            @if($item->total_borrowed > 0)
                                <a href="{{ route('admin.items.lending_details', $item->id) }}" class="badge bg-primary text-decoration-none">
                                    {{ $item->total_borrowed }} Dipinjam
                                </a>
                            @else
                                <span class="badge bg-secondary">0</span>
                            @endif
                        </td>

                        <td class="text-center">
                            <a href="{{ route('admin.items.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">Belum ada data barang.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

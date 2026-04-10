@extends('layouts.app')

@section('title', 'Detail Peminjaman Item')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.items.index') }}" class="btn btn-secondary btn-sm mb-3">
        <i class="bi bi-arrow-left"></i> Kembali ke Daftar Items
    </a>
    <h4 class="fw-bold">Riwayat Peminjaman: {{ $item->name }}</h4>
    <p class="text-muted">Kategori: {{ $item->category->name ?? '-' }} | Total Fisik: {{ $item->total }}</p>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3">
        <h5 class="mb-0 fw-bold">Daftar Peminjam Aktif & Riwayat</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Nama Peminjam</th>
                        <th class="text-center">Jumlah Dipinjam</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Status</th>
                        <th>Dicatat Oleh</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($lendings as $lending)
                    <tr>
                        <td>{{ $lending->name }}</td>
                        <td class="text-center fw-bold">{{ $lending->pivot->total_borrowed }}</td>
                        <td>{{ \Carbon\Carbon::parse($lending->loan_date)->format('d M Y') }}</td>
                        <td>
                            {{ $lending->return_date ? \Carbon\Carbon::parse($lending->return_date)->format('d M Y') : '-' }}
                        </td>
                        <td>
                            @if($lending->return_date)
                                <span class="badge bg-success">Sudah Dikembalikan</span>
                            @else
                                <span class="badge bg-warning text-dark">Masih Dipinjam</span>
                            @endif
                        </td>
                        <td>{{ $lending->editor->name ?? 'Sistem' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">Belum pernah ada riwayat peminjaman untuk barang ini.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

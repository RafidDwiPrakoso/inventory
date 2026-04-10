@extends('layouts.app')
@section('title', 'Data Peminjaman')
@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h5 class="mb-0 fw-bold">Riwayat Peminjaman Barang</h5>
        <div>
            <a href="{{ route('staff.borrows.export') }}" class="btn btn-success btn-sm me-2">
                <i class="bi bi-file-earmark-excel"></i> Export Excel
            </a>
            <a href="{{ route('staff.borrows.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-circle"></i> Catat Peminjaman Baru
            </a>
        </div>
    </div>

    <div class="card-body">
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Barang</th>
                        <th>Peminjam</th>
                        <th class="text-center">Jumlah</th>
                        <th>Tgl Pinjam</th>
                        <th>Tgl Kembali</th>
                        <th>Petugas Pencatat</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($borrows as $index => $b)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td class="fw-bold">{{ $b->itemStock->item_name ?? 'Barang Dihapus' }}</td>
                        <td>{{ $b->name_of_borrower }}</td>
                        <td class="text-center">{{ $b->total_item }}</td>
                        <td>{{ \Carbon\Carbon::parse($b->date)->format('d M Y H:i') }}</td>

                        <td>
                            {{ $b->returnedItem ? \Carbon\Carbon::parse($b->returnedItem->return_date)->format('d M Y H:i') : '-' }}
                        </td>

                        <td>
                            <div class="small" style="min-width: 150px;">
                                <span class="text-muted">Keluar via:</span> <br>
                                <i class="bi bi-person"></i> <b>{{ $b->staff->name ?? 'Unknown' }}</b>

                                <hr class="my-1 border-secondary opacity-25">

                                <span class="text-muted">Masuk via:</span> <br>
                                @if($b->returnedItem)
                                    <i class="bi bi-person-check-fill text-success"></i>
                                    <b class="text-success">{{ $b->returnedItem->staff->name ?? 'Unknown' }}</b>

                                    @if(isset($b->returnedItem->staff) && $b->returnedItem->staff->role === 'headstaff')
                                        <span class="badge bg-danger ms-1" style="font-size: 0.6rem;">Head Staff</span>
                                    @endif
                                @else
                                    <span class="text-warning"><i class="bi bi-clock"></i> Belum kembali</span>
                                @endif
                            </div>
                        </td>

                        <td class="text-center">
                            @if($b->returnedItem)
                                <span class="badge bg-success">Dikembalikan</span>
                            @else
                                <span class="badge bg-warning text-dark">Dipinjam</span>
                            @endif
                        </td>

                        <td class="text-center">
                            @if(!$b->returnedItem)
                                <button type="button" class="btn btn-success btn-sm me-1 mb-1" data-bs-toggle="modal" data-bs-target="#returnModal{{ $b->id }}">
                                    <i class="bi bi-arrow-return-left"></i> Return
                                </button>
                            @endif

                            <form action="{{ route('staff.borrows.destroy', $b->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus catatan ini?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm mb-1"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>

                    @if(!$b->returnedItem)
                    <div class="modal fade" id="returnModal{{ $b->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog text-start">
                            <div class="modal-content">
                                <div class="modal-header bg-success text-white">
                                    <h5 class="modal-title fw-bold"><i class="bi bi-arrow-return-left"></i> Form Pengembalian</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('staff.borrows.return', $b->id) }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <p>Kembalikan <b>{{ $b->total_item }}x {{ $b->itemStock->item_name }}</b> dari <b>{{ $b->name_of_borrower }}</b>?</p>

                                        <div class="mb-3">
                                            <label class="form-label">Tanggal & Waktu Kembali <span class="text-danger">*</span></label>
                                            <input type="datetime-local" class="form-control" name="return_date" value="{{ now()->format('Y-m-d\TH:i') }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Catatan Pengembalian (Opsional)</label>
                                            <textarea class="form-control" name="return_notes" rows="2" placeholder="Contoh: Barang kembali dalam kondisi baik"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-success">Proses Pengembalian</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif
                    @empty
                    <tr>
                        <td colspan="9" class="text-center text-muted py-4">Belum ada riwayat peminjaman yang dicatat.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

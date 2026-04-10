@extends('layouts.app')
@section('title', 'Detail Peminjaman')
@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3 d-flex align-items-center">
        <a href="{{ route('admin.items.index') }}" class="btn btn-secondary btn-sm me-3">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
        <h5 class="mb-0 fw-bold">Detail Peminjaman: <span class="text-primary">{{ $item->item_name }}</span></h5>
    </div>
    <div class="card-body">

        <div class="alert alert-info mb-4">
            <div class="row text-center">
                <div class="col-md-3 border-end">Total Fisik: <b>{{ $item->total_stock }}</b></div>
                <div class="col-md-3 border-end">Tersedia: <b class="text-success">{{ $item->available }}</b></div>
                <div class="col-md-3 border-end">Rusak: <b class="text-danger">{{ $item->total_repaired }}</b></div>
                <div class="col-md-3">Sedang Dipinjam: <b class="text-primary">{{ $item->total_borrowed }}</b></div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="5%">No</th>
                        <th>Nama Peminjam</th>
                        <th>Petugas Pencatat</th>
                        <th class="text-center">Jumlah Pinjam</th>
                        <th>Waktu Pinjam</th>
                        <th>Waktu Kembali</th>
                        <th class="text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($lendings as $index => $lending)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td class="fw-bold">{{ $lending->name_of_borrower }}</td>

                        <td>
                            <div class="small" style="min-width: 150px;">
                                <span class="text-muted">Keluar via:</span> <br>
                                <i class="bi bi-person"></i> <b>{{ $lending->staff->name ?? 'Unknown' }}</b>

                                <hr class="my-1 border-secondary opacity-25">

                                <span class="text-muted">Masuk via:</span> <br>
                                @if($lending->returnedItem)
                                    <i class="bi bi-person-check-fill text-success"></i>
                                    <b class="text-success">{{ $lending->returnedItem->staff->name ?? 'Unknown' }}</b>

                                    @if(isset($lending->returnedItem->staff) && $lending->returnedItem->staff->role === 'headstaff')
                                        <span class="badge bg-danger ms-1" style="font-size: 0.6rem;">Head Staff</span>
                                    @endif
                                @else
                                    <span class="text-warning"><i class="bi bi-clock"></i> Belum kembali</span>
                                @endif
                            </div>
                        </td>

                        <td class="text-center">{{ $lending->total_item }}</td>
                        <td>{{ \Carbon\Carbon::parse($lending->date)->format('d M Y H:i') }}</td>

                        <td>
                            @if($lending->returnedItem)
                                {{ \Carbon\Carbon::parse($lending->returnedItem->return_date)->format('d M Y H:i') }}
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>

                        <td class="text-center">
                            @if($lending->returnedItem)
                                <span class="badge bg-success"><i class="bi bi-check-circle"></i> Dikembalikan</span>
                            @else
                                <span class="badge bg-warning text-dark"><i class="bi bi-clock-history"></i> Dipinjam</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">Belum ada riwayat peminjaman untuk barang ini.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

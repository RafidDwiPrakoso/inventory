@extends('layouts.app')
@section('title', 'Catat Peminjaman')
@section('content')
<div class="card border-0 shadow-sm col-md-8 mx-auto">
    <div class="card-header bg-white py-3 d-flex align-items-center">
        <a href="{{ route('staff.borrows.index') }}" class="btn btn-secondary btn-sm me-3"><i class="bi bi-arrow-left"></i> Kembali</a>
        <h5 class="mb-0 fw-bold">Form Peminjaman Barang Baru</h5>
    </div>
    <div class="card-body">

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('staff.borrows.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Pilih Barang <span class="text-danger">*</span></label>
                    <select class="form-select" name="item_id" required>
                        <option value="" disabled selected>-- Pilih Barang Tersedia --</option>
                        @foreach($items as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->item_name }} (Sisa Stok: {{ $item->available }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Jumlah Dipinjam <span class="text-danger">*</span></label>
                    <input type="number" min="1" class="form-control" name="total_item" required placeholder="Contoh: 2">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama Peminjam <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="name_of_borrower" required placeholder="Nama siswa / guru">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Tanggal & Waktu Pinjam <span class="text-danger">*</span></label>
                    <input type="datetime-local" class="form-control" name="date" value="{{ now()->format('Y-m-d\TH:i') }}" required>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">Catatan Tambahan (Opsional)</label>
                <textarea class="form-control" name="notes" rows="3" placeholder="Keperluan peminjaman..."></textarea>
            </div>

            <button type="submit" class="btn btn-primary w-100 fw-bold">Simpan Peminjaman</button>
        </form>
    </div>
</div>
@endsection

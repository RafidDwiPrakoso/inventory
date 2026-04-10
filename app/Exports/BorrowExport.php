<?php

namespace App\Exports;

use App\Models\BorrowedItem;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Facades\Auth;

class BorrowExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        // KEAMANAN: Hanya cetak data yang dicatat oleh staff yang sedang login!
        return BorrowedItem::with(['itemStock', 'returnedItem'])
            ->where('staff_id', Auth::id())
            ->latest()
            ->get();
    }

    public function map($borrow): array
    {
        return [
            $borrow->itemStock->item_name ?? 'Barang Dihapus',
            $borrow->name_of_borrower,
            $borrow->total_item,
            \Carbon\Carbon::parse($borrow->date)->format('d M Y H:i'),

            // Cek apakah barang sudah dikembalikan atau belum
            $borrow->returnedItem ? \Carbon\Carbon::parse($borrow->returnedItem->return_date)->format('d M Y H:i') : 'Belum Dikembalikan',

            $borrow->notes ?? '-'
        ];
    }

    public function headings(): array
    {
        return [
            'Nama Barang',
            'Nama Peminjam',
            'Jumlah',
            'Waktu Pinjam',
            'Waktu Kembali',
            'Catatan Peminjaman'
        ];
    }
}

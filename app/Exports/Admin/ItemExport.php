<?php

namespace App\Exports\Admin;

use App\Models\ItemStock;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ItemExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     *
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return ItemStock::with('category')->get();
    }

    /**
     *
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID Barang',
            'Nama Barang',
            'Kategori',
            'Divisi',
            'Total Fisik',
            'Sisa Tersedia',
            'Sedang Rusak',
            'Sedang Dipinjam'
        ];
    }

    /**
     *
     *
     * @param mixed $item
     * @return array
     */
    public function map($item): array
    {
        return [
            $item->id,
            $item->item_name,
            $item->category->name ?? '-',
            $item->category->division ?? '-',
            $item->total_stock,
            $item->available,                
            $item->total_repaired,
            $item->total_borrowed,
        ];
    }
}

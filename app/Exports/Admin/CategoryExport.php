<?php

namespace App\Exports\Admin;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Models\ItemCategory;

// 1. TAMBAHKAN WithHeadings dan WithMapping di sini
class CategoryExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * Get the collection of categories to export.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection(): Collection
    {
        return ItemCategory::withCount('itemStocks')->get();
    }

    /**
     * Get the headings of the export.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'No',
            'Nama Kategori',
            'Divisi',
            'Total Barang',
        ];
    }

    /**
     * Map the category to an exportable array.
     *
     * @param mixed $category
     * @return array
     */
    public function map($category): array
    {
        return [
            $category->id,
            $category->name,
            $category->division,
            $category->item_stocks_count,
        ];
    }
}

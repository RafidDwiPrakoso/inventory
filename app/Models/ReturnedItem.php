<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnedItem extends Model
{
    use HasFactory;

    // Pastikan staff_id masuk ke dalam fillable
    protected $fillable = [
        'staff_id',
        'borrowed_item_id',
        'return_date',
        'notes'
    ];

    // Relasi untuk menarik data peminjam/barang (yang sudah ada)
    public function borrowedItem()
    {
        return $this->belongsTo(BorrowedItem::class);
    }

    // TAMBAHKAN INI: Relasi untuk mengetahui siapa staff yang menerima barang
    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }
}

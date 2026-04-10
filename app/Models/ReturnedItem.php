<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReturnedItem extends Model
{
    protected $table = 'returned_items';

    protected $fillable = [
        'staff_id',
        'borrowed_item_id',
        'return_date',
        'notes'
    ];

    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }

    public function borrowedItem()
    {
        return $this->belongsTo(BorrowedItem::class, 'borrowed_item_id');
    }
}

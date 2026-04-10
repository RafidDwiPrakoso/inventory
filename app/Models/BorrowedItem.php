<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BorrowedItem extends Model
{
    protected $table = 'borrowed_items';

    protected $fillable = [
        'staff_id',
        'item_id',
        'total_item',
        'name_of_borrower',
        'date',
        'notes'
    ];

    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }

    public function itemStock()
    {
        return $this->belongsTo(ItemStock::class, 'item_id');
    }

    public function returnedItem()
    {
        return $this->hasOne(ReturnedItem::class, 'borrowed_item_id');
    }
}

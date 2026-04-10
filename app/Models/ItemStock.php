<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemStock extends Model
{
    protected $table = 'item_stocks';

    protected $fillable = [
        'category_id',
        'item_name',
        'total_stock',
        'total_repaired',
        'total_borrowed'
    ];

    public function category()
    {
        return $this->belongsTo(ItemCategory::class, 'category_id');
    }

    public function borrowedItems()
    {
        return $this->hasMany(BorrowedItem::class, 'item_id');
    }

    public function getAvailableAttribute()
    {
        return $this->total_stock - $this->total_repaired - $this->total_borrowed;
    }
}

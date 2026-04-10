<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemCategory extends Model
{
    protected $table = 'item_categories';

    protected $fillable = ['name', 'division'];

    public function itemStocks()
    {
        return $this->hasMany(ItemStock::class, 'category_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function borrowedItems()
    {
        return $this->hasMany(BorrowedItem::class, 'staff_id');
    }

    public function returnedItems()
    {
        return $this->hasMany(ReturnedItem::class, 'staff_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lend extends Model
{
    use HasFactory;

    protected $fillable = [
        'returned',
        'return_forecast',
        'user_id',
        'lender_user_id'
    ];

    public function lender()
    {
        return $this->belongsTo(User::class, 'lender_user_id');
    }

    public function holder()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function books()
    {
        return $this->belongsToMany(Book::class, 'lend_book');
    }
}

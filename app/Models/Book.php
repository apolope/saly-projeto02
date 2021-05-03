<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'user_id'
    ];

    public function donor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function lends()
    {
        return $this->belongsToMany(Lend::class, 'lend_book');
    }
}

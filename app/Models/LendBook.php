<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LendBook extends Model
{
    use HasFactory;

    protected $table = 'lend_book';

    protected $fillable = [
        'comments',
        'lend_id',
        'book_id'
    ];

    public function lend()
    {
        return $this->hasOne(Lend::class, 'lend_id');
    }

    public function book()
    {
        return $this->hasOne(Book::class, 'book_id');
    }
}

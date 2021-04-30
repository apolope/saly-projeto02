<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BooksController extends Controller
{
    public function index()
    {
        $books = Book::get();

        return view('books.list', ['books' => $books]);
    }
}

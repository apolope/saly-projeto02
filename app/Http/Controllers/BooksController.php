<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Session;

class BooksController extends Controller
{
    public function index()
    {
        $books = Book::get();

        return view('books.list', ['books' => $books]);
    }

    public function new()
    {
        return view('books.form');
    }

    public function add(Request $request)
    {
        $book = new Book;
        $book = $book->create($request->all());
        $sessionString = 'O livro ' . $book->title . ' foi cadastrado com sucesso!';
        Session::flash('message', $sessionString);
        Session::flash('alert-class', 'alert-success');
        return redirect('books');
    }
}

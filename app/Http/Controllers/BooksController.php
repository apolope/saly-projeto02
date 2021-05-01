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

    public function create()
    {
        return view('books.form');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'author' => 'required',
            'donor' => 'required'
        ]);
        $book = new Book;
        $book = $book->create($request->all());
        $sessionString = 'O livro ' . $book->title . ' foi cadastrado com sucesso!';
        Session::flash('message', $sessionString);
        Session::flash('alert-class', 'alert-success');
        return redirect('books');
    }

    public function edit($id)
    {
        $book = new Book;
        $book = $book->findOrFail($id);
        return view('books.edit', ['book' => $book]);
    }

    public function update($id, Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'author' => 'required',
            'donor' => 'required'
        ]);
        $book = new Book;
        $bookHandler = $book::findOrFail($id);
        $book = $bookHandler->update($request->all());
        $bookHandler = $bookHandler::findOrFail($id);
        $sessionString = 'O livro ' . $bookHandler->title . ' foi atualizado com sucesso!';
        Session::flash('message', $sessionString);
        Session::flash('alert-class', 'alert-success');
        return redirect('books');
    }
}

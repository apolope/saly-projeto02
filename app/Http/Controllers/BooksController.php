<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use Session;
use Illuminate\Support\Facades\Auth;

class BooksController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $books = Book::with('user')->get();

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
            'author' => 'required'
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
        $book = Book::findOrFail($id);
        $users = User::pluck('name', 'id');
        return view('books.edit', ['book' => $book, 'users' => $users]);
    }

    public function update($id, Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'author' => 'required',
            'user_id' => 'required'
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

    public function delete($id)
    {
        $book = new Book;
        $bookHandler = $book::find($id);
        $title = $bookHandler->title;
        if ($bookHandler) {
            $bookHandler::destroy($id);
        }
        $sessionString = 'O livro ' . $title . ' foi deletado com sucesso!';
        Session::flash('message', $sessionString);
        Session::flash('alert-class', 'alert-danger');
        return redirect('books');
    }
}

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

    /**
     * Display a listing of the bokks.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::with('donor')->get();

        return view('books.list', ['books' => $books]);
    }

     /**
     * Show the form for creating a new book.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books.form');
    }

    /**
     * Store a newly created book in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Edit the specified book from database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $book = Book::findOrFail($id);
        $users = User::pluck('name', 'id');
        return view('books.edit', ['book' => $book, 'users' => $users]);
    }

    /**
     * Update the specified book from database.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(int $id, Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'author' => 'required',
            'user_id' => 'required'
        ]);
        $book = Book::findOrFail($id);
        $book->update($request->all());
        $sessionString = 'O livro ' . $book->title . ' foi atualizado com sucesso!';
        Session::flash('message', $sessionString);
        Session::flash('alert-class', 'alert-success');
        return redirect('books');
    }

    /**
     * Remove the specified book from database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $book = Book::Find($id);
        $book_title = $book->title;
        if ($book) {
            $book::destroy($id);
        }
        $sessionString = 'O livro ' . $book_title . ' foi deletado com sucesso!';
        Session::flash('message', $sessionString);
        Session::flash('alert-class', 'alert-danger');
        return redirect('books');
    }
}

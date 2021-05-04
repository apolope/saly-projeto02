<?php

namespace App\Http\Controllers;

use App\Models\Lend;
use App\Models\Book;
use App\Models\User;
use App\Models\LendBook;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Auth;

class LendsController extends Controller
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
     * Display a listing of the lends not returned.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lends = Lend::with('lender', 'holder', 'books')->where('returned', false)->get();
        return view('lends.list', ['lends' => $lends]);
    }

    /**
     * Display a listing of the lends not returned.
     *
     * @return \Illuminate\Http\Response
     */
    public function returned()
    {
        $lends = Lend::with('lender', 'holder', 'books')->where('returned',true)->get();
        return view('lends.returned', ['lends' => $lends]);
    }

    /**
     * Show the form for creating a new lend.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $active = Book::whereHas('lends', function($l)
        {
            $l->where('returned', false);
        })->get();
        $books = Book::WhereNotIn('id', $active->pluck('id')->toArray())->get()->pluck('title', 'id')->toArray();
        $users = User::all()->pluck('name', 'id');
        return view('lends.form', ['books' => $books, 'users' => $users]);

    }

    /**
     * Store a newly created lend in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'lender_user_id' => 'required',
            'selectBooksList' => 'required|array|min:1'
        ]);
        $lend = Lend::create([
            'return' => false,
            'return_forecast' => $request->return_forecast,
            'lender_user_id' => $request->lender_user_id,
            'user_id' => Auth::user()->id,
        ]);
        foreach ($request->selectBooksList as $b) {
            LendBook::create([
                'lend_id' => $lend->id,
                'book_id' => $b,
                ]);
            }
        $books_title = [];
        foreach (Book::whereIn('id', $request->selectBooksList)->get() as $b) {
            array_push($books_title, $b->title);
        }
        $sessionString = 'Saída do(s) livro(s) ' . implode(', ', $books_title) . ' cadastrada com sucesso!';
        Session::flash('message', $sessionString);
        Session::flash('alert-class', 'alert-success');
        return redirect('lends');
    }

    /**
     * Remove the specified lend from database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $Lend = Lend::Find($id);
        $books_title = $Lend->books->pluck('title')->toArray();
        if ($Lend) {
            $Lend::destroy($id);
        }
        $sessionString = 'Saída do(s) livro(s) ' . implode(', ', $books_title) . ' excluída com sucesso!';
        Session::flash('message', $sessionString);
        Session::flash('alert-class', 'alert-danger');
        return redirect('lends');
    }

    /**
     * Remove the specified lend from database.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function devolution(int $id, Request $request)
    {
        $lend = new Lend();
        $lendHandler = $lend::findOrFail($id);
        $lendHandler->update(['returned' => true]);

        $sessionString = 'Livro(s) ' . implode(", ", $lendHandler->books->pluck('title')->toArray()) . ' devolvido(s) com sucesso!';
        Session::flash('message', $sessionString);
        Session::flash('alert-class', 'alert-success');
        return redirect('lends');
    }
}

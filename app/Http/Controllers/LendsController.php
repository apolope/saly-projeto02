<?php

namespace App\Http\Controllers;

use App\Models\Lend;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Session;

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
        //
    }

    /**
     * Display the specified lend.
     *
     * @param  \App\Models\Lends  $lends
     * @return \Illuminate\Http\Response
     */
    public function show(Lends $lends)
    {
        //
    }

    /**
     * Show the form for editing the specified lend.
     *
     * @param  \App\Models\Lends  $lends
     * @return \Illuminate\Http\Response
     */
    public function edit(Lends $lends)
    {
        //
    }

    /**
     * Update the specified lend in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lends  $lends
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lends $lends)
    {
        //
    }

    /**
     * Remove the specified lend from database.
     *
     * @param  \App\Models\Lends  $lends
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lends $lends)
    {
        //
    }

    /**
     * Remove the specified lend from database.
     *
     * @param  \App\Models\Lends  $lends
     * @return \Illuminate\Http\Response
     */
    public function devolution(Request $request, int $id)
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

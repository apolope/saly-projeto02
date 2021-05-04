<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Lend;
use App\Models\Book;
use App\Models\LendBook;
use Carbon\Carbon;

class LendTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all()->pluck('id')->toArray();
        $lends = Lend::all()->pluck('id')->toArray();
        $books = Book::all()->pluck('id')->toArray();
        $activesBooks = $books;
        for ($i = 1; $i <= 15; $i++) {
            $returned = '';
            $numberBooksOnLend = 0;
            $numberActiveBooks = count($activesBooks);
            $booksOnLend = [];

            if ($numberActiveBooks > 0) {
                $returned = (bool)rand(0,1);
            } else {
                $returned = true;
            }

            if (!$returned) {
                $numberBooksOnLend = rand(1,$numberActiveBooks);
                for ($b = 0; $b < $numberBooksOnLend; $b++) {
                    $bookHandler = [];
                    array_push($bookHandler, collect($activesBooks)->random());
                    array_push($booksOnLend, $bookHandler);
                    $activesBooks = array_diff($activesBooks, $bookHandler);
                }
            } else {
                $numberBooksOnLend = rand(1,count($books));
                $booksOnReturned = $books;
                for ($b = 0; $b < $numberBooksOnLend; $b++) {
                    $bookHandler = [];
                    array_push($bookHandler, collect($booksOnReturned)->random());
                    array_push($booksOnLend, $bookHandler);
                    $booksOnReturned = array_diff($booksOnReturned, $bookHandler);
                }
            }

            $lend = new Lend();
            $lend->returned = $returned;
            $lend->return_forecast = Carbon::now()->addDays(rand(0, 10))->addMinutes(rand(1, 55));
            $lend->user_id = collect($users)->random();
            $lend->lender_user_id = collect($users)->random();
            $lend->created_at = Carbon::now();
            $lend->updated_at = Carbon::now();
            $lend->save();

            foreach ($booksOnLend as $book) {
                $lend_book = new LendBook();
                $lend_book->comments = null;
                $lend_book->lend_id = $lend->id;
                $lend_book->book_id = $book[0];
                $lend_book->created_at = Carbon::now();
                $lend_book->updated_at = Carbon::now();
                $lend_book->save();
            }
        };
    }
}

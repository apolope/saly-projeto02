<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Lend;
use App\Models\Book;
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
        for ($i = 1; $i <= 15; $i++) {
            DB::table('lends')->insert([
                [
                    'returned' => (bool)rand(0,1),
                    'return_forecast' => Carbon::now()->addDays(rand(0, 10))->addMinutes(rand(1, 55)),
                    'user_id' => collect($users)->random(),
                    'lender_user_id' => collect($users)->random(),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]
            ]);
        };
        $lends = Lend::all()->pluck('id')->toArray();
        $books = Book::all()->pluck('id')->toArray();
        for ($i = 1; $i <= 35; $i++) {
            DB::table('lend_book')->insert([
                'comments' => null,
                'lend_id' => collect($lends)->random(),
                'book_id' => collect($books)->random(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        };


    }
}

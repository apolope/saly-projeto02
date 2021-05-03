<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Carbon\Carbon;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all()->pluck('id')->toArray();
        DB::table('books')->insert([
            [
                'title' => 'Jane Eyre',
                'author' => 'Charlotte Bronte',
                'user_id' => collect($users)->random(),
                'created_at' => Carbon::now()->subDays(rand(0, 200))->subMinutes(rand(1, 55)),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Wuthering Heights',
                'author' => 'Emily Brontë',
                'user_id' => collect($users)->random(),
                'created_at' => Carbon::now()->subDays(rand(0, 200))->subMinutes(rand(1, 55)),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Moby Dick',
                'author' => 'Herman Melville',
                'user_id' => collect($users)->random(),
                'created_at' => Carbon::now()->subDays(rand(0, 200))->subMinutes(rand(1, 55)),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Pride and Prejudice',
                'author' => 'Jane Austen',
                'user_id' => collect($users)->random(),
                'created_at' => Carbon::now()->subDays(rand(0, 200))->subMinutes(rand(1, 55)),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'The Great Gatsby',
                'author' => 'F. Scott Fitzgerald',
                'user_id' => collect($users)->random(),
                'created_at' => Carbon::now()->subDays(rand(0, 200))->subMinutes(rand(1, 55)),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Frankenstein',
                'author' => 'Mary Shelley',
                'user_id' => collect($users)->random(),
                'created_at' => Carbon::now()->subDays(rand(0, 200))->subMinutes(rand(1, 55)),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Robison Crusoe',
                'author' => 'Daniel Defoe',
                'user_id' => collect($users)->random(),
                'created_at' => Carbon::now()->subDays(rand(0, 200))->subMinutes(rand(1, 55)),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Little Women',
                'author' => 'Louisa May Alcott',
                'user_id' => collect($users)->random(),
                'created_at' => Carbon::now()->subDays(rand(0, 200))->subMinutes(rand(1, 55)),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}

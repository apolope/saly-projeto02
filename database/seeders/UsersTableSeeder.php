<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Apolonio Serafim',
                'email' => 'apolonio.serafim@hotmail.com',
                'email_verified_at' => null,
                'password' => Hash::make('12345678'),
                'remember_token' => null,
                'created_at' => Carbon::now()->subDays(rand(200, 365))->subMinutes(rand(1, 55)),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Joao Pacheco',
                'email' => 'joao.pacheco@hotmail.com',
                'email_verified_at' => null,
                'password' => Hash::make('12345678'),
                'remember_token' => null,
                'created_at' => Carbon::now()->subDays(rand(200, 365))->subMinutes(rand(1, 55)),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Alfredo Demesio',
                'email' => 'alfredo.demesio@hotmail.com',
                'email_verified_at' => null,
                'password' => Hash::make('12345678'),
                'remember_token' => null,
                'created_at' => Carbon::now()->subDays(rand(200, 365))->subMinutes(rand(1, 55)),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Dismenio Antonio',
                'email' => 'dismenio.antonio@hotmail.com',
                'email_verified_at' => null,
                'password' => Hash::make('12345678'),
                'remember_token' => null,
                'created_at' => Carbon::now()->subDays(rand(200, 365))->subMinutes(rand(1, 55)),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}

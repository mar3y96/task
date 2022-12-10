<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::firstOrCreate([
            'email' => 'admin@test.com',
        ], [
            'email' => 'admin@test.com',
            'password' => bcrypt('password'), // password
            'remember_token' => Str::random(10),
        ]);
    }
}

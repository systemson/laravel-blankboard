<?php

namespace Systemson\Blankboard\Seeds;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use DB;
use Hash;

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
                'name' => 'Administrator',
                'email' => 'admin@admin.com',
                'password' => Hash::make('1234'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Test User',
                'email' => 'test@test.com',
                'password' => Hash::make('secret'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}

<?php

namespace Systemson\Blankboard\Seeds;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'name' => 'Administrator',
                'description' => 'Main administrator role.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Guest',
                'description' => 'Newly registered user role.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}

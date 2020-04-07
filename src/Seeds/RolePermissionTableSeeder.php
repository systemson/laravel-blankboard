<?php

namespace Systemson\Blankboard\Seeds;

use Illuminate\Database\Seeder;
use DB;
use Carbon\Carbon;

class RolePermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_permission')->insert([
            [
                'role_id' => 1,
                'permission_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}

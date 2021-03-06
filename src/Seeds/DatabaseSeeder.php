<?php

namespace Systemson\Blankboard\Seeds;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            RolesTableSeeder::class,
            UserRoleTableSeeder::class,
            PermissionsTableSeeder::class,
            RolePermissionTableSeeder::class,
        ]);
    }
}

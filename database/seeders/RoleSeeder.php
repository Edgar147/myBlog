<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use Illuminate\Support\Facades\DB;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Role::factory()->times(10)->create(); if generate fake roles
        DB::table('roles')->insert(['name'=>'SuperAdmin']);
        DB::table('roles')->insert(['name'=>'Admin']);
        DB::table('roles')->insert(['name'=>'User']);
    }
}

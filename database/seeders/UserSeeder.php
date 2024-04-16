<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([ [ 'name'     => 'Edgar S. O.',
                                       'email'    => 'eserrano@sinprol.com.mx',
                                       'password' => bcrypt('123123123') ], ]);
    }
}

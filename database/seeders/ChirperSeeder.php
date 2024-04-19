<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

//use App\Models\Chirp;

class ChirperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Chirp::factory()->count(50);
        for ($i = 0; $i < 50; $i++) {
            DB::table('chirps')->insert([ 'user_id' => 1,
                                          'message' => Str::random(20), ]);
        }
    }
}

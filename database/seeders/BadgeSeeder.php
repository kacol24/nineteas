<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use QCod\Gamify\Badge;

class BadgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (! Badge::get()->count()) {
            DB::table('badges')
              ->insert([
                  [
                      'name'       => 'Bibit',
                      'created_at' => now(),
                      'updated_at' => now(),
                  ],
                  [
                      'name'       => 'Tunas',
                      'created_at' => now(),
                      'updated_at' => now(),
                  ],
                  [
                      'name'       => 'Tanaman',
                      'created_at' => now(),
                      'updated_at' => now(),
                  ],
                  [
                      'name'       => 'Pucuk Teh',
                      'created_at' => now(),
                      'updated_at' => now(),
                  ],
              ]);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $premios = [
            ['award' => 'Premio 1'],
            ['award' => 'Premio 2'],
            ['award' => 'Premio 3'],
            ['award' => 'Premio 4'],
        ];
        DB::table('awards')->insert($premios);
    }
}

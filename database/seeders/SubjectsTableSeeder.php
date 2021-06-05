<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subjects')->insert([
            'name' => 'Português',
            'teacher' => null,
            'substitute' => null,
            'created_at' => now()
        ]);

        DB::table('subjects')->insert([
            'name' => 'Inglês',
            'teacher' => null,
            'substitute' => null,
            'created_at' => now()
        ]);

        DB::table('subjects')->insert([
            'name' => 'Espanhol',
            'teacher' => null,
            'substitute' => null,
            'created_at' => now()
        ]);

        DB::table('subjects')->insert([
            'name' => 'Literatura',
            'teacher' => null,
            'substitute' => null,
            'created_at' => now()
        ]);

        DB::table('subjects')->insert([
            'name' => 'Matemática',
            'teacher' => null,
            'substitute' => null,
            'created_at' => now()
        ]);

        DB::table('subjects')->insert([
            'name' => 'Geografia',
            'teacher' => null,
            'substitute' => null,
            'created_at' => now()
        ]);

        DB::table('subjects')->insert([
            'name' => 'História',
            'teacher' => null,
            'substitute' => null,
            'created_at' => now()
        ]);

        DB::table('subjects')->insert([
            'name' => 'Física',
            'teacher' => null,
            'substitute' => null,
            'created_at' => now()
        ]);
    }
}

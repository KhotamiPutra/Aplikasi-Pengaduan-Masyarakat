<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Petugas extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('petugas')->insert([
            'id_petugas' => '1',
            'nama_petugas' => 'admin',
            'username' => 'admin',
            'password' => bcrypt('1'),
            'telp' => '08123456789',
            'level' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('petugas')->insert([
            'id_petugas' => '2',
            'nama_petugas' => 'petugas',
            'username' => 'petugas',
            'password' => bcrypt('1'),
            'telp' => '08123456789',
            'level' => 'petugas',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

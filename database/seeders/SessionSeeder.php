<?php

namespace Database\Seeders;

use App\Models\Session;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        session::create([
            'time' => '08:00-12:00'
        ]);

        session::create([
            'time' => '13:00-17:00'
        ]);

        session::create([
            'time' => '18:00-22:00'
        ]);
    }
}

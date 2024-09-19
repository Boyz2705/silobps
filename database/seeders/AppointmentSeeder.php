<?php

namespace Database\Seeders;

use App\Models\Appointment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Appointment::create([
            'user_id' => 2,
            'pet_id' => 3,
            'service_id' => 3,
            'clinic_id' => 2,
            'session_id' => 3,
            'app_date' => '2022-11-17',
            'detail' => 'Tidak mau makan',
            'bill' => 10
        ]);

        Appointment::create([
            'user_id' => 2,
            'pet_id' => 1,
            'service_id' => 1,
            'clinic_id' => 1,
            'session_id' => 1,
            'app_date' => '2022-11-17',
            'detail' => 'Batuk-batuk',
            'bill' => 10
        ]);

        Appointment::create([
            'user_id' => 2,
            'pet_id' => 4,
            'service_id' => 3,
            'clinic_id' => 1,
            'session_id' => 1,
            'app_date' => '2022-11-17',
            'detail' => 'sakit kepala',
            'bill' => 10
        ]);

        Appointment::create([
            'user_id' => 2,
            'pet_id' => 1,
            'service_id' => 3,
            'clinic_id' => 3,
            'session_id' => 2,
            'app_date' => '2022-11-17',
            'detail' => 'masuk angin',
            'bill' => 10
        ]);
    }
}

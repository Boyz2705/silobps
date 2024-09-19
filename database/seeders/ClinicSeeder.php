<?php

namespace Database\Seeders;

use App\Models\clinic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClinicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        clinic::create([
            'clinic_name' => 'Clinic Moestopo',
            'clinic_address' => 'Jl. Mayjen Prof. Dr. Moestopo',
            'img_link' => 'https://i.pinimg.com/originals/43/db/a4/43dba4ad5630f8b11c8ce3097850c9b5.jpg',
            'map_link' => 'https://goo.gl/maps/wjYbKBDFLuu3Cygq5'
        ]);

        clinic::create([
            'clinic_name' => 'Clinic Airlangga',
            'clinic_address' => 'Jl. Airlangga',
            'img_link' => 'https://archello.s3.eu-central-1.amazonaws.com/images/2020/03/17/Liqui-Group--Browns-Pet-Store-1920-0282.1584452538.8015.jpg',
            'map_link' => 'https://goo.gl/maps/7fjFBwTFtJm5jxAC6'
        ]);

        clinic::create([
            'clinic_name' => 'Clinic Merr',
            'clinic_address' => 'Jl. Dr. Ir. H. Soekarno',
            'img_link' => 'https://www.thepetpractice.com.au/wp-content/uploads/2017/05/pet-practise-scaled.jpg',
            'map_link' => 'https://goo.gl/maps/97QCcfqZGXNrohMa6'
        ]);

        clinic::create([
            'clinic_name' => 'Clinic Gresik',
            'clinic_address' => 'Jl. DR. Wahidin Sudiro Husodo',
            'img_link' => 'https://i.pinimg.com/1200x/7d/2c/ef/7d2cefd6133ec6df960fe28d294b9fd1.jpg',
            'map_link' => 'https://goo.gl/maps/jJ7Y7dyq6ZpX4tut6'
        ]);

        clinic::create([
            'clinic_name' => 'Clinic Lamongan',
            'clinic_address' => 'Jl. Kusuma Bangsa',
            'img_link' => 'https://i.pinimg.com/originals/1c/5e/4d/1c5e4d1c3977f7e3a11c9c5df5c381e6.jpg',
            'map_link' => 'https://goo.gl/maps/wTtn2X6SMTU4zdqY6'
        ]);

        clinic::create([
            'clinic_name' => 'Clinic Banyuwangi',
            'clinic_address' => 'Jl. Wijaya Kusuma',
            'img_link' => 'http://nyc-interiordesign.com/wp-content/uploads/2015/02/03_500-x-750-Commerciasl-Animal-Clinic_03.jpg',
            'map_link' => 'https://goo.gl/maps/2PttjhjJgY5Kp5bu9'
        ]);
    }
}

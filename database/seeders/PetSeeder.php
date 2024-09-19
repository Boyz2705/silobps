<?php

namespace Database\Seeders;

use App\Models\Pet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pet::create([
            'pet_name' => 'Dog'
        ]);
        Pet::create([
            'pet_name' => 'Cat'
        ]);
        Pet::create([
            'pet_name' => 'Rabbit'
        ]);
        Pet::create([
            'pet_name' => 'Bird'
        ]);
        Pet::create([
            'pet_name' => 'Reptile'
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        service::create([
            'services_name' => 'Grooming',
            'img_link' => 'https://images.unsplash.com/photo-1516734212186-a967f81ad0d7?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1171&q=80',
            'srv_routes' => '/grooming',
            'price' => 15
        ]);
        service::create([
            'services_name' => 'Consultation',
            'img_link' => 'https://www.westerncape.gov.za/sites/www.westerncape.gov.za/files/boy-with-dog-at-vet.jpg',
            'srv_routes' => '/consultation',
            'price' => 10
        ]);
        service::create([
            'services_name' => 'Health Check & Vaccination',
            'img_link' => 'https://cdn-prd.content.metamorphosis.com/wp-content/uploads/sites/2/2021/03/shutterstock_1503829781-1-768x512.jpg',
            'srv_routes' => '/vaccine',
            'price' => 20
        ]);
        service::create([
            'services_name' => 'Small Surgery',
            'img_link' => 'https://d2zp5xs5cp8zlg.cloudfront.net/image-42128-800.jpg',
            'srv_routes' => '/surgery',
            'price' => 45
        ]);
    }
}

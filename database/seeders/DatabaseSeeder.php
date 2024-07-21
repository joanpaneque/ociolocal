<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Company;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        User::factory()->create([
            'name' => 'Test User 2',
            'email' => 'test2@example.com'
        ]);

        User::create([
            'avatar' => '/assets/default/XD.jpg',
            'enterprise' => 1,
            'name' => 'Nuria Vega Design',
            'email' => 'contact@nuriavegadesign.com',
            'password' => 'password1223334444',
        ]);


        Company::create([
            'user_id' => 1,
            'company_name' => 'Chic Roses',
            'company_email' => 'anonymous@anonymous.com',
            'company_phone' => '123456789',
            'company_address' => 'Calle Anonima',
            'company_nif' => '12345678A',
            'legal_representative_name' => 'Anonymous',
            'legal_representative_email' => 'anonymous@anonymous.com',
            'legal_representative_phone' => '123456789',
            'iban' => 'ES123456789',
            'image' => '/assets/default/chic.png'
        ]);

        Company::create([
            'user_id' => 3,
            'company_name' => 'Nuria Vega Design',
            'company_email' => 'contact@nuriavegadesign.com',
            'company_phone' => '123456789',
            'company_address' => 'Calle Anonima',
            'company_nif' => '12345678A',
            'legal_representative_name' => 'Nuria Vega Design',
            'legal_representative_email' => 'contact@nuriavegadesign.com',
            'legal_representative_phone' => '123456789',
            'iban' => 'ES123456789',
            'image' => '/assets/default/nuriavegadesign.png',
        ]);
    }
}

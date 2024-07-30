<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Company;
use App\Models\Activity;
use App\Models\Image;
use App\Models\ActivityImage;

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
        
        Activity::create([
            'company_id' => 1,
            'activity_name' => 'Opera random',
            'season' => 1,
            'date_start' => '2021-10-01',
            'date_end' => '2021-10-31',
            'date_event' => '2021-10-31',
            'ticket_types' => json_encode([
                ['name' => 'Entrada general', 'price' => 100]
            ]),
            'weekly_schedule' => json_encode([
                'monday' => [
                    [
                        'start' => '10:00',
                        'end' => '14:00'
                    ],
                    [
                        'start' => '16:00',
                        'end' => '20:00'
                    ]
                ],
                'tuesday' => [
                    [
                        'start' => '10:00',
                        'end' => '14:00'
                    ],
                    [
                        'start' => '16:00',
                        'end' => '20:00'
                    ]
                ],
                'wednesday' => [
                    [
                        'start' => '10:00',
                        'end' => '14:00'
                    ],
                    [
                        'start' => '16:00',
                        'end' => '20:00'
                    ]
                ],
                'thursday' => [
                    [
                        'start' => '10:00',
                        'end' => '14:00'
                    ],
                    [
                        'start' => '16:00',
                        'end' => '20:00'
                    ]
                ],
                'friday' => [
                    [
                        'start' => '10:00',
                        'end' => '14:00'
                    ],
                    [
                        'start' => '16:00',
                        'end' => '20:00'
                    ]
                ],
                'saturday' => [
                    [
                        'start' => '10:00',
                        'end' => '14:00'
                    ],
                    [
                        'start' => '16:00',
                        'end' => '20:00'
                    ]
                ],
                'sunday' => [
                    [
                        'start' => '10:00',
                        'end' => '14:00'
                    ],
                    [
                        'start' => '16:00',
                        'end' => '20:00'
                    ]
                ]
            ]),
            'max_concurrent_people' => 200,
            'contribution' => 10
        ]);

        Image::create([
            'url' => '/assets/default/a.jpg',
            'description' => 'First image',
        ]);

        Image::create([
            'url' => '/assets/default/b.jpg',
            'description' => 'Second image',
        ]);

        Image::create([
            'url' => '/assets/default/c.jpg',
            'description' => 'Third image',
        ]);

        Image::create([
            'url' => '/assets/default/d.jpg',
            'description' => 'Fourth image',
        ]);

        Image::create([
            'url' => '/assets/default/e.jpg',
            'description' => 'Fifth image',
        ]);

        ActivityImage::create([
            'activity_id' => 1,
            'image_id' => 1,
        ]);

        ActivityImage::create([
            'activity_id' => 1,
            'image_id' => 2,
        ]);

        ActivityImage::create([
            'activity_id' => 1,
            'image_id' => 3,
        ]);

        ActivityImage::create([
            'activity_id' => 1,
            'image_id' => 4,
        ]);

        ActivityImage::create([
            'activity_id' => 1,
            'image_id' => 5,
        ]);

        Company::create([
            'user_id' => 2,
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

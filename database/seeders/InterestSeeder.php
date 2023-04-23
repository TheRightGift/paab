<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InterestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $interests = [
            [
                'title' => 'Ophthalmologists',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Euismod urna faucibus nunc etiam nulla aliquam.',
                'icon' => '/media/img/templates/1/otho.svg',
            ],
            [
                'title' => 'Gynecologists',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Euismod urna faucibus nunc etiam nulla aliquam.',
                'icon' => '/media/img/templates/1/cadio.svg',
            ],
            [
                'title' => 'Dermatologists',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Euismod urna faucibus nunc etiam nulla aliquam.',
                'icon' => '/media/img/templates/1/pedia.svg',
            ],
            [
                'title' => 'Allergists',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Euismod urna faucibus nunc etiam nulla aliquam.',
                'icon' => '/media/img/templates/1/gastro.svg'
            ],
            [
                'title' => 'Pediatric',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Euismod urna faucibus nunc etiam nulla aliquam.',
                'icon' => '/media/img/templates/1/pedia.svg'
            ],
            [
                'title' => 'Neurologists',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Euismod urna faucibus nunc etiam nulla aliquam.',
                'icon' => '/media/img/templates/1/cadio.svg'
            ],
            [
                'title' => 'Psychiatrists',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Euismod urna faucibus nunc etiam nulla aliquam.',
                'icon' => '/media/img/templates/1/otho.svg'
            ],
            [
                'title' => 'Cadiology',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Euismod urna faucibus nunc etiam nulla aliquam.',
                'icon' => '/media/img/templates/1/cadio.svg'
            ],
            [
                'title' => 'Orthopaedics',
                'description' => 'Orthopedists treat a wide variety of musculoskeletal conditions. These conditions may be present from birth, or they may result from an injury or age-related wear and tear.',
                'icon' => '/media/img/templates/1/otho.svg'
            ]
        ];
        collect($interests)->each(function ($interest) {\App\Models\Interest::create($interest);});
    }
}

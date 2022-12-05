<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Eloquent;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Eloquent::unguard();
        $country = 'database/countries.sql';
        $state = 'database/states.sql';
        $city = 'database/cities.sql';
        DB::unprepared(file_get_contents($country));
        DB::unprepared(file_get_contents($state));
        DB::unprepared(file_get_contents($city));
        $this->command->info('Country States Cities table seeded!');
        // \App\Models\User::factory(10)->create();
        
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}

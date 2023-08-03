<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plans = [
            [
                'name' => '.com', 
                'slug' => 'dotCom', 
                'stripe_plan' => 'price_1N9xKmGol1wahrlSl4XkMDTn', 
                'price' => 144, 
                'description' => 'BasicDotCom'
            ],
            [
                'name' => '.doctor', 
                'slug' => 'dotDoctor', 
                'stripe_plan' => 'price_1NZuDQGol1wahrlSximl9naO', 
                'price' => 213.04, 
                'description' => 'PremiumDotDoctor'
            ]
        ];
  
        foreach ($plans as $plan) {
            Plan::create($plan);
        }
    }
}

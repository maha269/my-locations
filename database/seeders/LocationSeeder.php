<?php

namespace Database\Seeders;

use App\Models\Location;
use App\Models\User;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::get();
        $location1 = Location::factory()->create(['lat'=>'41.7670556','lng'=>'-2.4693927']);
        $location2 = Location::factory()->create(['lat'=>'41.3968583','lng'=>'2.1503971']);
        foreach ($users as $user) {
            for ($i = 0; $i < 3 ; $i++) {
                $user->locations()->sync([$location1->id,$location2->id]);
            }
        }
    }
}

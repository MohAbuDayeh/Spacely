<?php

namespace Database\Seeders;

use App\Models\Amenity;
use App\Models\Workspace;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */

    public function run(): void
    {

        DB::table('amenities')->insert([
            ['name' => '24/7 Access'],
            ['name' => 'Accessibility'],
            ['name' => 'Coffee/Tea'],
            ['name' => 'Door w/Lock'],
            ['name' => 'Kitchen'],
            ['name' => 'Window View'],
            ['name' => 'Print/Scan/Copy'],
            ['name' => 'WiFi Phone'],
            ['name' => 'Parking'],
            ['name' => 'Catering'],
            ['name' => 'Hosted Reception'],
            ['name' => 'On-site Restaurant'],
        ]);

    }
}

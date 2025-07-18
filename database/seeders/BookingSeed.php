<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\Hotel;
use Illuminate\Support\Facades\Artisan;

class BookingSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Hotel::count() == 0) {
            Artisan::call('db:seed', [
                '--class' => 'HotelSeeder',
            ]);
        }
        Booking::factory()->count(10)->create();
    }
}

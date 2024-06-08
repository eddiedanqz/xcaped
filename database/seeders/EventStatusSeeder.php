<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('event_statuses')->insert([
            [
                'name' => 'Pending',
                'slug' => 'pending',
            ],
            [
                'name' => 'Published',
                'slug' => 'published',
            ],
            [
                'name' => 'Cancelled',
                'slug' => 'cancelled',
            ],
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\ActivityPurpose;
use Illuminate\Database\Seeder;

class ActivityPurposeSeeder extends Seeder
{
    public function run(): void
    {
        $names = [
            'Seminars',
            'Department Days',
            'Party',
            'Pageant',
            'Symposium',
            'Awarding/Recognition Ceremony',
            'CCS DAYS',
        ];

        foreach ($names as $name) {
            ActivityPurpose::firstOrCreate(['name' => $name]);
        }
    }
}

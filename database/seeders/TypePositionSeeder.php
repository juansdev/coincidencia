<?php

namespace Database\Seeders;

use App\Models\TypePosition;
use Illuminate\Database\Seeder;

class TypePositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $typePositions = [
            "POLITICO",
            "OTRO",
            "CANTANTE",
            "ACTOR"
        ];

        foreach ($typePositions as $typePosition) {
            TypePosition::create([
                'name' => $typePosition
            ]);
        }
    }
}

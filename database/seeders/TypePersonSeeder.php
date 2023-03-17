<?php

namespace Database\Seeders;

use App\Models\TypePerson;
use Illuminate\Database\Seeder;

class TypePersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $typePersons = [
            "NO APLICA",
            "PREFERENTE",
            "NO PREFERENTE",
        ];

        foreach ($typePersons as $typePerson) {
            TypePerson::create([
                'name' => $typePerson
            ]);
        }
    }
}

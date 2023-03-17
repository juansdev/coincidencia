<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            'AMAZONAS',
            'ANTIOQUIA',
            'ARAUCA',
            'ATLANTICO',
            'BOGOTA D.C.',
            'BOLIVAR',
            'BOYACA',
            'CALDAS',
            'CAQUETA',
            'CASANARE',
            'CAUCA',
            'CESAR',
            'CHOCO',
            'CORDOBA',
            'CUNDINAMARCA',
            'GUAINIA',
            'GUAVIARE',
            'HUILA',
            'LA_GUAJIRA',
            'MAGDALENA',
            'META',
            'NARIÑO',
            'NORTE_DE_SANTANDER',
            'PUTUMAYO',
            'QUINDIO',
            'RISARALDA',
            'SAN ANDRES',
            'SANTANDER',
            'SUCRE',
            'TOLIMA',
            'VALLE',
            'VAUPES',
            'VICHADA',
        ];

        foreach ($departments as $department) {
            Department::create([
                'name' => $department
            ]);
        }
    }
}

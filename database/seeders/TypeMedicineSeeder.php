<?php

namespace Database\Seeders;

use App\Models\type_medicine;
use Illuminate\Database\Seeder;

class TypeMedicineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type = [' محلي ', ' مستورد '];
        type_medicine::create([
            "name" => $type[0],
        ]);
        type_medicine::create([
            "name" => $type[1],
        ]);
    }
}

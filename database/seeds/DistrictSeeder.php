<?php

use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run(){
        $districts = [

            ["id" => 1, "code" => "AMRITSAR", "name" => "Amritsar", "status" => 1],
            ["id" => 2, "code" => "BARNALA", "name" => "Barnala", "status" => 1],
            ["id" => 3, "code" => "BATHINDA", "name" => "Bathinda", "status" => 1],
            ["id" => 4, "code" => "FARIDKOT", "name" => "Faridkot", "status" => 1],
            ["id" => 5, "code" => "FATEHGARH_SAHIB", "name" => "Fatehgarh Sahib", "status" => 1],
            ["id" => 6, "code" => "FAZILKA", "name" => "Fazilka", "status" => 1],
            ["id" => 7, "code" => "FIROZPUR", "name" => "Firozpur", "status" => 1],
            ["id" => 8, "code" => "GURDASPUR", "name" => "Gurdaspur", "status" => 1],
            ["id" => 9, "code" => "HOSHIARPUR", "name" => "Hoshiarpur", "status" => 1],
            ["id" => 10, "code" => "JALANDHAR", "name" => "Jalandhar", "status" => 1],
            ["id" => 11, "code" => "KAPURTHALA", "name" => "Kapurthala", "status" => 1],
            ["id" => 12, "code" => "KHANNA", "name" => "Khanna", "status" => 1],
            ["id" => 13, "code" => "LUDHIANA", "name" => "Ludhiana", "status" => 1],
            ["id" => 14, "code" => "MANSA", "name" => "Mansa", "status" => 1],
            ["id" => 15, "code" => "MALERKOTLA", "name" => "Malerkotla", "status" => 1],
            ["id" => 16, "code" => "MOGA", "name" => "Moga", "status" => 1],
            ["id" => 17, "code" => "MOHALI", "name" => "Mohali", "status" => 1],
            ["id" => 18, "code" => "MUKTSAR", "name" => "Muktsar", "status" => 1],
            ["id" => 19, "code" => "NAWANSHAHR", "name" => "Nawanshahr", "status" => 1],
            ["id" => 20, "code" => "PATHANKOT", "name" => "Pathankot", "status" => 1],
            ["id" => 21, "code" => "PATIALA", "name" => "Patiala", "status" => 1],
            ["id" => 22, "code" => "ROPAR", "name" => "Ropar", "status" => 1],
            ["id" => 23, "code" => "SANGRUR", "name" => "Sangrur", "status" => 1],
            ["id" => 24, "code" => "TARN_TARAN", "name" => "Tarn Taran", "status" => 1],
        ];

        \App\District::insert($districts);
        //
    }
}

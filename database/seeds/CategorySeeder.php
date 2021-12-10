<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        //

        $categories = [

            ["id" => 1, "code" => "U-12", "name" => "U-12(Born on or After 1.1.2010)", "status" => 1],
            ["id" => 2, "code" => "U-14", "name" => "U-14(Born on or After 1.1.2008)", "status" => 1],
            ["id" => 3, "code" => "U-16", "name" => "U-16(Born on or After 1.1.2006)", "status" => 1],
            ["id" => 4, "code" => "U-18", "name" => "U-18(Born on or After 1.1.2004)", "status" => 1],
            ["id" => 5, "code" => "MENS", "name" => "U-21", "status" => 1],
            ["id" => 6, "code" => "MENS/WOMEN", "name" => "Mens/Womens", "status" => 1],
            ["id" => 7, "code" => "MENS/WOMEN", "name" => "Veteran", "status" => 1],
        ];
        \App\Category::insert($categories);
    }
}

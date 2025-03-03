<?php

namespace Database\Seeders;

use App\Models\category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data=['technolgy category','sport category','fashoin category'];
        $date=fake()->date('Y-m-d h:m:s');

        foreach($data as $item){

            category::create([
                'name'=>$item,
                'slug'=>Str::slug($item),
                'status'=>(1), 
                'created_at'=>$date,
                'updated_at'=>$date,
            ]);

        }


    }
}

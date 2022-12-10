<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::create(['title'=>'Sport']);
        Category::create(['title'=>'Politics']);
        Category::create(['title'=>'Birthday']);
    }
}

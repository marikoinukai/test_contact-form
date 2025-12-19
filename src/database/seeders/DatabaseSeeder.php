<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    // 1. 先にカテゴリを5件作成
    \App\Models\Category::factory(5)->create();

    // 2. その後にコンタクトを35件作成
    \App\Models\Contact::factory(35)->create();
    }
}

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

    // 1. 作成した CategorySeeder を呼び出して日本語の5項目を登録
    $this->call(CategorySeeder::class);
    
    // 2. その後にコンタクトを35件作成
    \App\Models\Contact::factory(35)->create();
    }
}

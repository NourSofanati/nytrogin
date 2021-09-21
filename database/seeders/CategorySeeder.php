<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name' => 'الكافيهات'
        ]);
        DB::table('categories')->insert([
            'name' => 'الفعاليات الحية'
        ]);
        DB::table('categories')->insert([
            'name' => 'مدينة الألعاب'
        ]);
        DB::table('categories')->insert([
            'name' => 'المطاعم'
        ]);
        DB::table('categories')->insert([
            'name' => 'صالة العرض'
        ]);
        DB::table('categories')->insert([
            'name' => 'الممرات الرئيسية'
        ]);
    }
}

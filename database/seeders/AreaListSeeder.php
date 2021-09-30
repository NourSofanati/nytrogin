<?php

namespace Database\Seeders;

use App\Models\AreaList;
use Illuminate\Database\Seeder;

class AreaListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AreaList::create(['name' => 'المنطقة الشرقية']);
        AreaList::create(['name' => 'المنطقة الوسطى']);
        AreaList::create(['name' => 'المنطقة الغربية']);
    }
}

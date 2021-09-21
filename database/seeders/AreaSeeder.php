<?php

namespace Database\Seeders;

use App\Models\Area;
use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
{

    private $areas_json = '[
        {
          "region_id": 1,
          "capital_city_id": 3,
          "code": "RD",
          "name_ar": "منطقة الرياض",
          "name_en": "Riyadh",
          "population": 6777146,
          "center": [
            24.69999996,
            46.73333003
          ]
        },
        {
          "region_id": 2,
          "capital_city_id": 6,
          "code": "MQ",
          "name_ar": "منطقة مكة المكرمة",
          "name_en": "Makkah",
          "population": 6915006,
          "center": [
            21.42717994,
            39.84349001
          ]
        },
        {
          "region_id": 3,
          "capital_city_id": 14,
          "code": "MN",
          "name_ar": "منطقة المدينة المنورة",
          "name_en": "Madinah",
          "population": 1777933,
          "center": [
            24.47057996,
            39.60781006
          ]
        },
        {
          "region_id": 4,
          "capital_city_id": 11,
          "code": "QA",
          "name_ar": "منطقة القصيم",
          "name_en": "Qassim",
          "population": 1215858,
          "center": [
            26.33033999,
            43.97435997
          ]
        },
        {
          "region_id": 5,
          "capital_city_id": 13,
          "code": "SQ",
          "name_ar": "المنطقة الشرقية",
          "name_en": "Eastern Province",
          "population": 4105780,
          "center": [
            26.44199002,
            50.10919981
          ]
        },
        {
          "region_id": 6,
          "capital_city_id": 15,
          "code": "AS",
          "name_ar": "منطقة عسير",
          "name_en": "Asir",
          "population": 1913392,
          "center": [
            18.21667,
            42.50000002
          ]
        },
        {
          "region_id": 7,
          "capital_city_id": 1,
          "code": "TB",
          "name_ar": "منطقة تبوك",
          "name_en": "Tabuk",
          "population": 791535,
          "center": [
            28.41463997,
            36.53387003
          ]
        },
        {
          "region_id": 8,
          "capital_city_id": 10,
          "code": "HA",
          "name_ar": "منطقة حائل",
          "name_en": "Hail",
          "population": 597144,
          "center": [
            27.53054999,
            41.69733002
          ]
        },
        {
          "region_id": 9,
          "capital_city_id": 2213,
          "code": "SH",
          "name_ar": "منطقة الحدود الشمالية",
          "name_en": "Northern Borders",
          "population": 320524,
          "center": [
            30.97214998,
            41.01332997
          ]
        },
        {
          "region_id": 10,
          "capital_city_id": 17,
          "code": "GA",
          "name_ar": "منطقة جازان",
          "name_en": "Jazan",
          "population": 1365110,
          "center": [
            16.89671995,
            42.55360001
          ]
        },
        {
          "region_id": 11,
          "capital_city_id": 3417,
          "code": "NG",
          "name_ar": "منطقة نجران",
          "name_en": "Najran",
          "population": 505652,
          "center": [
            17.5408618,
            44.2663834
          ]
        },
        {
          "region_id": 12,
          "capital_city_id": 1542,
          "code": "BA",
          "name_ar": "منطقة الباحة",
          "name_en": "Bahah",
          "population": 411888,
          "center": [
            20.00695006,
            41.46314
          ]
        },
        {
          "region_id": 13,
          "capital_city_id": 2237,
          "code": "GO",
          "name_ar": "منطقة الجوف",
          "name_en": "Jawf",
          "population": 440009,
          "center": [
            29.9728,
            40.21416997
          ]
        }
      ]';


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $areas = json_decode($this->areas_json);
        foreach ($areas as $area) {
            Area::create([
                'name' => $area->name_ar,
                'region_id' => $area->region_id,
            ]);
        }
    }
}

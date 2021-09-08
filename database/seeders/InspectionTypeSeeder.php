<?php

namespace Database\Seeders;

use App\Models\InspectionType;
use Illuminate\Database\Seeder;

class InspectionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds
     *
     * @return void
     */
    public function run()
    {
        InspectionType::create(['name' => 'سعة المنطقة']);
        InspectionType::create(['name' => 'طريق خدمات الطوارئ']);
        InspectionType::create(['name' => 'الإخلاء ومخرج الطوارئ']);
        InspectionType::create(['name' => 'لافتات الطريق']);
        InspectionType::create(['name' => 'الطوارئ الطبية']);
        InspectionType::create(['name' => 'تأمين الموقع من الجمهور']);
        InspectionType::create(['name' => 'التزم الموظفون بقواعد ولوائح الوقاية الشخصية']);
        InspectionType::create(['name' => 'تقارير يومية / أسبوعية']);
        InspectionType::create(['name' => 'الإبلاغ عن الحوادث']);
        InspectionType::create(['name' => 'فريق المرور في الموقع']);
        InspectionType::create(['name' => 'تقارير إعلامية عن جميع الأحداث']);
        InspectionType::create(['name' => 'التفتيش ميكانيكيا']);
        InspectionType::create(['name' => 'التفتيش ميكانيكيا']);
        InspectionType::create(['name' => 'التفتيش كهربائيا']);
        InspectionType::create(['name' => 'التفتيش كهربائيا']);
        InspectionType::create(['name' => 'تدريبية حول السلامة']);
        InspectionType::create(['name' => 'سياسات وإجراءات الصحة والسلامة الخاصة بمناطق الأحداث']);
        InspectionType::create(['name' => 'نشاء تقييم للمخاطر لإدارة الحشود والأمن والحرائق و COVID-19']);
        InspectionType::create(['name' => 'السلامة من الحرائق مع توزيع طفايات الحريق']);
        InspectionType::create(['name' => 'محطات الإسعافات الأولية مخزنة']);
        InspectionType::create(['name' => 'تسرب للوقود']);
        InspectionType::create(['name' => 'تنفيذ لوائح Covid-19']);
        InspectionType::create(['name' => 'طفايات حريق']);
        InspectionType::create(['name' => 'نقل المواد غير المستخدمة بانتظام']);
        InspectionType::create(['name' => 'التفتيش اليومي للموقع']);
        InspectionType::create(['name' => 'الممرات إلى المناطق واضحة']);
        InspectionType::create(['name' => 'مجموعة من طرق الطوارئ للمركبات']);
        InspectionType::create(['name' => 'المداخل الخلفية']);
    }
}

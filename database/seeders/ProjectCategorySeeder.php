<?php

namespace Database\Seeders;

use App\Models\ProjectCategory;
use Illuminate\Database\Seeder;

class ProjectCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProjectCategory::create([
            'name' => 'العروض الحية في المطاعم والمقاهي',
            'comma_seperated_list' =>
            "هل المنشأة تحمل تصريح ساري المفعول من الهيئة العامة للترفيه,
            هل تم الالتزام بما ورد في بيانات النشاط المصرح له,
            هل تم الالتزام بالسماح للمفتشين بالدخول لموقع النشاط وتسهيل أدائهم لمهامهم,
            هل تم الالتزام بإيقاف الموسيقى والعروض قبل الاذان ب15 دقيقه وحتى 45 دقيقة بعد الأذان,
            هل تم الالتزام بعدم خروج الصوت خارج حدود مقر النشاط,
            هل تم الالتزام بالتعاقد مع مؤدين معتمدين من قبل الهيئة,
            هل تم الالتزام بالمظهر واللباس والسلوك الاحترافي للمؤدين,
            هل تم الالتزام بموقع العرض لمؤدي النشاط المقدم للهيئة، وعدم الخروج منه، حيث يتم فصل المؤدي عن الحاضرين,
            هل تم الالتزام بتعيين مسؤول متواجد طوال فترة إقامة العرض,
            هل تم الالتزام بتوفير كاميرات مراقبة في المطعم/المقهى,
            هل تم الالتزام بعدم فرض رسوم أو بيع تذاكر لحضور العروض المقدمة,
            هل تم الالتزام بعدم إقامة عروض التنسيق الموسيقي (الدي جي),
            هل تم الالتزام بعدم إقامة عروض الكاريوكي,
            هل تم الالتزام بوقت العرض المحدد في التصريح"
        ]);
        ProjectCategory::create([
            'name' => 'الفعاليات الترفيهية',
            'comma_seperated_list' => "هل المنشأة تحمل تصريح ساري المفعول من الهيئة العامة للترفيه  ,
ل تم الالتزام بالسماح للمفتشين بالدخول لموقع النشاط وتسهيل أدائهم لمهامهم,
هل تم الالتزام بإيقاف الموسيقى والعروض قبل الاذان ب15 دقيقه وحتى 45 دقيقة بعد الأذان,
هل تم الالتزام بعدم خروج الصوت خارج حدود مقر النشاط,
هل تم توفير بطاقات تعريفية للعاملين، وسترات مميزة تبين مهامهم.,
هل تم التعاقد مع شركات الحراسات الأمنية المرخصة لحفظ الأمن والسلامة وتوفير الحراسة من الجنسين حسب فئة الزوار المستهدفة، ,
هل تم عرض خريطة تفصيلية للموقع بشكل واضح للزوار ولوحات إرشادية داخل وخارج الموقع,
هل تم الالتزام بالمظهر اللائق والسلوك الاحترافي.,
هل تم الالتزام ببيع التذاكر من خلال مزود خدمة معتمد من قبل الهيئة,
هل تم الالتزام بتعيين مسؤول متواجد طوال فترة الفعالية,
هل تم الالتزام بتوفير كاميرات مراقبة في الفعالية"
        ]);
        ProjectCategory::create([
            'name' => 'مراكز الترفيه ومدن الملاهي',
            'comma_seperated_list' => "هل المنشأة تحمل تصريح ساري المفعول من الهيئة العامة للترفيه  ,
            ل تم الالتزام بالسماح للمفتشين بالدخول لموقع النشاط وتسهيل أدائهم لمهامهم,
            هل تم الالتزام بإيقاف الموسيقى والعروض قبل الاذان ب15 دقيقه وحتى 45 دقيقة بعد الأذان,
            هل تم الالتزام بعدم خروج الصوت خارج حدود مقر النشاط,
            هل تم عرض خريطة تفصيلية للموقع بشكل واضح للزوار ولوحات إرشادية داخل وخارج الموقع.,
            هل تم توفير بطاقات تعريفية للعاملين، وسترات مميزة تبين مهامهم.,
            هل تم الالتزام بالمظهر اللائق والسلوك الاحترافي.,
            هل تم تطبيق إرشادات واشتراطات وتعليمات السلامة للألعاب والأركان التفاعلية وغيرها من الأنشطة الترفيهية وعرضها في مكان واضح ومناسب.,
            هل تم التعاقد مع شركات الحراسات الأمنية المرخصة لحفظ الأمن والسلامة وتوفير الحراسة من الجنسين حسب فئة الزوار المستهدفة,
            هل تم توفير تجهيزات للإسعافات الأولية، وتواجد دائم لمسعفين في الموقع,
            هل تم تحديد مكتب لخدمة العملاء بالموقع لتقديم الدعم اللازم ,
            هل تم الالتزام بتعيين مسؤول متواجد طوال فترة تشغيل المركز,
            هل تم الالتزام بتوفير كاميرات مراقبة في المركز"
        ]);
    }
}
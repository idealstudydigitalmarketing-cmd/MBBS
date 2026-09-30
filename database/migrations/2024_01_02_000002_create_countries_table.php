<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();         // germany, poland, etc.
            $table->string('name');
            $table->string('flag_emoji', 10);
            $table->string('tagline');
            $table->text('description');
            $table->string('duration')->default('6 Years (MD)');
            $table->string('language')->default('English');
            $table->string('tuition_range');          // e.g. €6,000 – €8,000
            $table->string('living_cost_range');      // e.g. €500 – €700
            $table->string('total_cost');             // e.g. ~€85,000
            $table->string('intake_month');
            $table->boolean('nmc_approved')->default(true);
            $table->boolean('usmle_track')->default(true);
            $table->boolean('neet_required')->default(true);
            $table->string('min_marks')->default('50% in PCB');
            $table->string('entrance_exam')->default('Biology/Chemistry');
            $table->string('image_path')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        $countries = [
            ['slug'=>'poland',  'name'=>'Poland',         'flag_emoji'=>'🇵🇱','tagline'=>'Most Popular MBBS Destination',      'description'=>'Poland is the #1 choice for South Asian students seeking MBBS in Europe. With 13 NMC and WHO-recognised medical universities offering English-medium programs, Poland combines European quality with a large, welcoming international student community.','duration'=>'6 Years (MD)','language'=>'English','tuition_range'=>'€6,000 – €8,000','living_cost_range'=>'€500 – €700','total_cost'=>'~€85,000','intake_month'=>'October','nmc_approved'=>1,'usmle_track'=>1,'neet_required'=>1,'min_marks'=>'50% in PCB','entrance_exam'=>'Biology/Chemistry','image_path'=>'assets/poland-krakow.jpg','is_active'=>1,'sort_order'=>1],
            ['slug'=>'hungary', 'name'=>'Hungary',        'flag_emoji'=>'🇭🇺','tagline'=>'Top Medical Programs in Europe',       'description'=>'Hungary is home to some of Europe\'s most prestigious medical universities, including Semmelweis University. Hungarian medical degrees are globally ranked and specifically recognised for USMLE.','duration'=>'6 Years (MD)','language'=>'English','tuition_range'=>'€14,000 – €18,000','living_cost_range'=>'€600 – €900','total_cost'=>'~€150,000','intake_month'=>'September','nmc_approved'=>1,'usmle_track'=>1,'neet_required'=>1,'min_marks'=>'50% in PCB','entrance_exam'=>'Biology/Chemistry','image_path'=>'assets/budapest-hungary.jpg','is_active'=>1,'sort_order'=>2],
            ['slug'=>'czech',   'name'=>'Czech Republic', 'flag_emoji'=>'🇨🇿','tagline'=>'Rich Academic Heritage',               'description'=>'Charles University Prague is one of the oldest universities in Europe, with outstanding medical faculties delivering EU-standard education at competitive fees.','duration'=>'6 Years (MD)','language'=>'English','tuition_range'=>'€8,000 – €14,000','living_cost_range'=>'€600 – €800','total_cost'=>'~€110,000','intake_month'=>'October','nmc_approved'=>1,'usmle_track'=>1,'neet_required'=>1,'min_marks'=>'50% in PCB','entrance_exam'=>'Biology/Chemistry','image_path'=>null,'is_active'=>1,'sort_order'=>3],
            ['slug'=>'romania', 'name'=>'Romania',        'flag_emoji'=>'🇷🇴','tagline'=>'Most Affordable European MBBS',         'description'=>'Romania offers excellent medical education with the lowest cost of living in Europe — ideal for budget-conscious students without compromising on quality.','duration'=>'6 Years (MD)','language'=>'English','tuition_range'=>'€4,000 – €6,000','living_cost_range'=>'€300 – €500','total_cost'=>'~€55,000','intake_month'=>'October','nmc_approved'=>1,'usmle_track'=>1,'neet_required'=>1,'min_marks'=>'50% in PCB','entrance_exam'=>'Biology/Chemistry','image_path'=>null,'is_active'=>1,'sort_order'=>4],
            ['slug'=>'latvia',  'name'=>'Latvia',         'flag_emoji'=>'🇱🇻','tagline'=>'EU Degree at Low Cost',                 'description'=>'Riga Stradiņš University is WHO and NMC recognised, offering full EU-standard degrees at very competitive fees with a vibrant international student community.','duration'=>'6 Years (MD)','language'=>'English','tuition_range'=>'€7,000 – €9,000','living_cost_range'=>'€500 – €700','total_cost'=>'~€90,000','intake_month'=>'September','nmc_approved'=>1,'usmle_track'=>1,'neet_required'=>1,'min_marks'=>'50% in PCB','entrance_exam'=>'Biology/Chemistry','image_path'=>null,'is_active'=>1,'sort_order'=>5],
            ['slug'=>'germany', 'name'=>'Germany',        'flag_emoji'=>'🇩🇪','tagline'=>'Excellence in Medical Science',         'description'=>'Home to world-renowned institutions with advanced research infrastructure and top-ranked clinical training programmes. Germany offers near-free education at public universities.','duration'=>'6 Years (MD)','language'=>'English + German','tuition_range'=>'€500 – €3,000','living_cost_range'=>'€700 – €1,000','total_cost'=>'~€55,000','intake_month'=>'October','nmc_approved'=>1,'usmle_track'=>1,'neet_required'=>1,'min_marks'=>'50% in PCB','entrance_exam'=>'Biology/Chemistry','image_path'=>null,'is_active'=>1,'sort_order'=>6],
        ];

        foreach ($countries as $c) {
            $c['created_at'] = now(); $c['updated_at'] = now();
            DB::table('countries')->insert($c);
        }
    }

    public function down(): void { Schema::dropIfExists('countries'); }
};

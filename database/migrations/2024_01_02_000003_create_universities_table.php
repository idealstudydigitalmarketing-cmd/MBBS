<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('universities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('city');
            $table->string('country_slug');           // foreign reference
            $table->string('flag_emoji', 10);
            $table->integer('rank')->default(0);
            $table->string('annual_fee');             // e.g. From €9,500/yr
            $table->text('tags')->nullable();         // JSON: ["WHO Recognized","NMC Approved"]
            $table->text('description')->nullable();
            $table->string('established')->nullable(); // e.g. 1364
            $table->boolean('who_approved')->default(true);
            $table->boolean('nmc_listed')->default(true);
            $table->boolean('usmle_track')->default(false);
            $table->string('language')->default('English');
            $table->string('image_path')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        $universities = [
            ['name'=>'Jagiellonian University Medical College','city'=>'Kraków','country_slug'=>'poland','flag_emoji'=>'🇵🇱','rank'=>1,'annual_fee'=>'From €9,500/yr','tags'=>'["WHO Recognized","NMC Approved","English"]','description'=>'One of the oldest and most prestigious medical universities in Europe, founded in 1364.','established'=>'1364','who_approved'=>1,'nmc_listed'=>1,'usmle_track'=>1,'language'=>'English','image_path'=>null,'is_active'=>1,'sort_order'=>1],
            ['name'=>'Semmelweis University','city'=>'Budapest','country_slug'=>'hungary','flag_emoji'=>'🇭🇺','rank'=>2,'annual_fee'=>'From €14,000/yr','tags'=>'["Top Ranked","USMLE Track","English"]','description'=>'Hungary\'s most prestigious medical university with dedicated USMLE preparation tracks.','established'=>'1769','who_approved'=>1,'nmc_listed'=>1,'usmle_track'=>1,'language'=>'English','image_path'=>null,'is_active'=>1,'sort_order'=>2],
            ['name'=>'Charles University','city'=>'Prague','country_slug'=>'czech','flag_emoji'=>'🇨🇿','rank'=>3,'annual_fee'=>'From €12,000/yr','tags'=>'["Est. 1348","EU Recognized","English"]','description'=>'One of the oldest universities in Central Europe with outstanding medical faculties.','established'=>'1348','who_approved'=>1,'nmc_listed'=>1,'usmle_track'=>1,'language'=>'English','image_path'=>null,'is_active'=>1,'sort_order'=>3],
            ['name'=>'Wroclaw Medical University','city'=>'Wroclaw','country_slug'=>'poland','flag_emoji'=>'🇵🇱','rank'=>4,'annual_fee'=>'From €8,000/yr','tags'=>'["NMC Listed","No Entrance","English"]','description'=>'A leading Polish medical university with a strong international student program.','established'=>'1946','who_approved'=>1,'nmc_listed'=>1,'usmle_track'=>0,'language'=>'English','image_path'=>null,'is_active'=>1,'sort_order'=>4],
            ['name'=>'Riga Stradiņš University','city'=>'Riga','country_slug'=>'latvia','flag_emoji'=>'🇱🇻','rank'=>5,'annual_fee'=>'From €8,000/yr','tags'=>'["WHO Approved","Research Hub","English"]','description'=>'Latvia\'s premier medical university, WHO and NMC recognised with full EU-standard degrees.','established'=>'1950','who_approved'=>1,'nmc_listed'=>1,'usmle_track'=>0,'language'=>'English','image_path'=>null,'is_active'=>1,'sort_order'=>5],
            ['name'=>'Iuliu Hatieganu University','city'=>'Cluj-Napoca','country_slug'=>'romania','flag_emoji'=>'🇷🇴','rank'=>6,'annual_fee'=>'From €4,500/yr','tags'=>'["Affordable","NMC Listed","English"]','description'=>'Romania\'s top medical school offering affordable, high-quality medical education.','established'=>'1919','who_approved'=>1,'nmc_listed'=>1,'usmle_track'=>0,'language'=>'English','image_path'=>null,'is_active'=>1,'sort_order'=>6],
        ];

        foreach ($universities as $u) {
            $u['created_at'] = now(); $u['updated_at'] = now();
            DB::table('universities')->insert($u);
        }
    }

    public function down(): void { Schema::dropIfExists('universities'); }
};

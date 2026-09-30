<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('university');
            $table->string('country_slug')->nullable();
            $table->string('flag_emoji', 10)->nullable();
            $table->string('year_batch')->nullable();  // e.g. MBBS 3rd Year
            $table->text('quote');
            $table->integer('stars')->default(5);
            $table->string('avatar_initials', 5)->nullable();
            $table->string('photo_path')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category')->default('Guide');
            $table->string('author')->default('EuroMedStudy Team');
            $table->string('read_time')->default('5 min read');
            $table->string('featured_image')->nullable();
            $table->text('excerpt');
            $table->longText('content');
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->boolean('is_published')->default(false);
            $table->timestamp('published_at')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // Seed testimonials
        $testimonials = [
            ['name'=>'Riya Sharma','university'=>'Jagiellonian University','country_slug'=>'poland','flag_emoji'=>'🇵🇱','year_batch'=>'MBBS 3rd Year','quote'=>'EuroMedStudy made my dream of studying medicine in Poland a reality. Their visa support and counselling was incredible. I\'m now in my 3rd year at Jagiellonian University!','stars'=>5,'avatar_initials'=>'RS','is_active'=>1,'sort_order'=>1],
            ['name'=>'Ahmed Khan','university'=>'Iuliu Hatieganu University','country_slug'=>'romania','flag_emoji'=>'🇷🇴','year_batch'=>'MBBS 2nd Year','quote'=>'The team helped me choose Romania and I\'m saving so much compared to private colleges back home. The quality of education is absolutely top-notch — no regrets!','stars'=>5,'avatar_initials'=>'AK','is_active'=>1,'sort_order'=>2],
            ['name'=>'Priya Mehta','university'=>'Semmelweis University','country_slug'=>'hungary','flag_emoji'=>'🇭🇺','year_batch'=>'MBBS 1st Year','quote'=>'Getting into Semmelweis University in Hungary was a dream come true. EuroMedStudy guided me through every step. I highly recommend them to all medical aspirants!','stars'=>5,'avatar_initials'=>'PM','is_active'=>1,'sort_order'=>3],
            ['name'=>'Suresh Kumar','university'=>'Charles University','country_slug'=>'czech','flag_emoji'=>'🇨🇿','year_batch'=>'MBBS 4th Year','quote'=>'Charles University Prague is an amazing place to study medicine. EuroMedStudy\'s support from day one made everything smooth and stress-free. Worth every penny!','stars'=>5,'avatar_initials'=>'SK','is_active'=>1,'sort_order'=>4],
        ];

        foreach ($testimonials as $t) {
            $t['created_at'] = now(); $t['updated_at'] = now();
            DB::table('testimonials')->insert($t);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('testimonials');
        Schema::dropIfExists('blog_posts');
    }
};

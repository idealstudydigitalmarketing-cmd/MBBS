<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('type')->default('text'); // text, textarea, image, boolean
            $table->string('label');
            $table->string('group')->default('general');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // Seed default settings
        $settings = [
            // Hero Section
            ['key'=>'hero_eyebrow',      'value'=>'— MBBS Abroad Consultancy · Est. 2012',           'type'=>'text',    'label'=>'Hero Eyebrow Text',     'group'=>'hero',    'sort_order'=>1],
            ['key'=>'hero_line1',        'value'=>'Study',                                            'type'=>'text',    'label'=>'Hero Title Line 1',     'group'=>'hero',    'sort_order'=>2],
            ['key'=>'hero_line2',        'value'=>'Medicine',                                         'type'=>'text',    'label'=>'Hero Title Line 2 (Italic)','group'=>'hero','sort_order'=>3],
            ['key'=>'hero_line3',        'value'=>'in Europe.',                                       'type'=>'text',    'label'=>'Hero Title Line 3',     'group'=>'hero',    'sort_order'=>4],
            ['key'=>'hero_subtitle',     'value'=>'WHO & NMC-approved degrees at top European universities. English-taught, no donation fees — with expert guidance from counselling to graduation.','type'=>'textarea','label'=>'Hero Subtitle','group'=>'hero','sort_order'=>5],
            ['key'=>'hero_cta_primary',  'value'=>'Book Free Counselling',                            'type'=>'text',    'label'=>'Primary CTA Button Text','group'=>'hero',   'sort_order'=>6],
            ['key'=>'hero_cta_secondary','value'=>'Explore Destinations',                             'type'=>'text',    'label'=>'Secondary CTA Button Text','group'=>'hero',  'sort_order'=>7],
            // Stats
            ['key'=>'stat_students',     'value'=>'10,000+',  'type'=>'text', 'label'=>'Students Placed Stat', 'group'=>'stats','sort_order'=>1],
            ['key'=>'stat_universities', 'value'=>'50+',      'type'=>'text', 'label'=>'Partner Universities Stat','group'=>'stats','sort_order'=>2],
            ['key'=>'stat_visa',         'value'=>'95%',      'type'=>'text', 'label'=>'Visa Success Rate Stat', 'group'=>'stats','sort_order'=>3],
            ['key'=>'stat_years',        'value'=>'14',       'type'=>'text', 'label'=>'Years Experience Stat',  'group'=>'stats','sort_order'=>4],
            // About
            ['key'=>'about_title',       'value'=>'Your Gateway to a World-Class Medical Career',    'type'=>'text',    'label'=>'About Section Title',   'group'=>'about',   'sort_order'=>1],
            ['key'=>'about_body',        'value'=>'EuroMedStudy has been guiding aspiring doctors from India, Pakistan, Nepal, Bangladesh, and Africa for over 14 years — with unmatched expertise across 6 European countries and 50+ partner universities.','type'=>'textarea','label'=>'About Body Text','group'=>'about','sort_order'=>2],
            // CTA Banner
            ['key'=>'cta_heading',       'value'=>'Ready to Study Medicine in Europe?',              'type'=>'text',    'label'=>'CTA Banner Heading',    'group'=>'cta',     'sort_order'=>1],
            ['key'=>'cta_subtext',       'value'=>'Book your free counselling session today. Our experts guide you on the best university, country, fees, and admission process — at zero cost, zero obligation.','type'=>'textarea','label'=>'CTA Sub Text','group'=>'cta','sort_order'=>2],
            // Contact
            ['key'=>'whatsapp_number',   'value'=>'+919876543210',  'type'=>'text', 'label'=>'WhatsApp Number',   'group'=>'contact','sort_order'=>1],
            ['key'=>'email_address',     'value'=>'info@euromedstudy.com','type'=>'text','label'=>'Contact Email','group'=>'contact','sort_order'=>2],
            ['key'=>'phone_number',      'value'=>'+91 98765 43210','type'=>'text', 'label'=>'Phone Number',      'group'=>'contact','sort_order'=>3],
            ['key'=>'office_address',    'value'=>'New Delhi, India',   'type'=>'textarea','label'=>'Office Address','group'=>'contact','sort_order'=>4],
            // SEO
            ['key'=>'meta_title',        'value'=>'Study MBBS in Europe 2025 | Affordable Medical Degrees – EuroMedStudy','type'=>'text','label'=>'Meta Title','group'=>'seo','sort_order'=>1],
            ['key'=>'meta_description',  'value'=>'Study MBBS in Europe at top WHO & NMC-approved universities. English-taught programs from €3,000/yr. Free counselling for Indian, Pakistani & Nepali students.','type'=>'textarea','label'=>'Meta Description','group'=>'seo','sort_order'=>2],
        ];

        foreach ($settings as $s) {
            $s['created_at'] = now();
            $s['updated_at'] = now();
            DB::table('site_settings')->insert($s);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};

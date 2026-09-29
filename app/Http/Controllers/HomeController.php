<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $countries = [
            ['flag' => '🇩🇪', 'name' => 'Germany', 'tagline' => 'Excellence in Medical Science', 'duration' => '6 Years', 'language' => 'English + German', 'fees' => '€500–€3,000/yr', 'intake' => 'October', 'desc' => 'Home to world-renowned institutions with advanced research infrastructure and clinical training programs.'],
            ['flag' => '🇵🇱', 'name' => 'Poland', 'tagline' => 'Most Popular MBBS Destination', 'duration' => '6 Years', 'language' => 'English', 'fees' => '€6,000–€8,000/yr', 'intake' => 'October', 'desc' => 'Poland offers 13 medical universities with English-taught programs, NMC recognized, and vibrant student life.'],
            ['flag' => '🇭🇺', 'name' => 'Hungary', 'tagline' => 'Top Medical Programs in Europe', 'duration' => '6 Years', 'language' => 'English', 'fees' => '€14,000–€18,000/yr', 'intake' => 'September', 'desc' => 'Semmelweis University and University of Pécs are globally ranked, offering USMLE preparation tracks.'],
            ['flag' => '🇨🇿', 'name' => 'Czech Republic', 'tagline' => 'Rich Academic Heritage', 'duration' => '6 Years', 'language' => 'English', 'fees' => '€8,000–€14,000/yr', 'intake' => 'October', 'desc' => 'Charles University – one of the oldest universities in Europe, with outstanding medical faculties.'],
            ['flag' => '🇷🇴', 'name' => 'Romania', 'tagline' => 'Most Affordable European Option', 'duration' => '6 Years', 'language' => 'English', 'fees' => '€4,000–€6,000/yr', 'intake' => 'October', 'desc' => 'Romania offers excellent medical education with a very low cost of living, making it budget-friendly.'],
            ['flag' => '🇱🇻', 'name' => 'Latvia', 'tagline' => 'EU Degree at Low Cost', 'duration' => '6 Years', 'language' => 'English', 'fees' => '€7,000–€9,000/yr', 'intake' => 'September', 'desc' => 'Riga Stradiņš University is WHO and NMC recognized, offering EU-standard degrees at competitive fees.'],
        ];

        $universities = [
            ['rank' => '#1', 'flag' => '🇵🇱', 'name' => 'Jagiellonian University Medical College', 'city' => 'Kraków, Poland', 'tags' => ['WHO Recognized', 'NMC Approved', 'English'], 'fee' => 'From €9,500/yr'],
            ['rank' => '#2', 'flag' => '🇭🇺', 'name' => 'Semmelweis University', 'city' => 'Budapest, Hungary', 'tags' => ['Top Ranked', 'USMLE Track', 'English'], 'fee' => 'From €14,000/yr'],
            ['rank' => '#3', 'flag' => '🇨🇿', 'name' => 'Charles University', 'city' => 'Prague, Czech Republic', 'tags' => ['Est. 1348', 'EU Recognized', 'English'], 'fee' => 'From €12,000/yr'],
            ['rank' => '#4', 'flag' => '🇵🇱', 'name' => 'Wroclaw Medical University', 'city' => 'Wroclaw, Poland', 'tags' => ['NMC Listed', 'No Entrance', 'English'], 'fee' => 'From €8,000/yr'],
            ['rank' => '#5', 'flag' => '🇱🇻', 'name' => 'Riga Stradiņš University', 'city' => 'Riga, Latvia', 'tags' => ['WHO Approved', 'Research Hub', 'English'], 'fee' => 'From €8,000/yr'],
            ['rank' => '#6', 'flag' => '🇷🇴', 'name' => 'Iuliu Hatieganu University', 'city' => 'Cluj-Napoca, Romania', 'tags' => ['Affordable', 'NMC Listed', 'English'], 'fee' => 'From €4,500/yr'],
        ];

        $fees = [
            ['flag' => '🇩🇪', 'country' => 'Germany',        'tuition' => '€500 – €3,000',    'living' => '€700 – €1,000', 'total' => '~€55,000'],
            ['flag' => '🇵🇱', 'country' => 'Poland',         'tuition' => '€6,000 – €8,000',  'living' => '€500 – €700',   'total' => '~€85,000'],
            ['flag' => '🇭🇺', 'country' => 'Hungary',        'tuition' => '€14,000 – €18,000','living' => '€600 – €900',   'total' => '~€150,000'],
            ['flag' => '🇨🇿', 'country' => 'Czech Republic', 'tuition' => '€8,000 – €14,000', 'living' => '€600 – €800',   'total' => '~€110,000', 'highlight' => false],
            ['flag' => '🇷🇴', 'country' => 'Romania',        'tuition' => '€4,000 – €6,000',  'living' => '€300 – €500',   'total' => '~€55,000',  'highlight' => true],
            ['flag' => '🇱🇻', 'country' => 'Latvia',         'tuition' => '€7,000 – €9,000',  'living' => '€500 – €700',   'total' => '~€90,000'],
        ];

        $faqs = [
            ['q' => 'Is MBBS from Europe valid in India / Pakistan / Nepal?', 'a' => 'Yes. MBBS degrees from WHO and NMC-listed European universities are valid in India, Pakistan, Nepal, and other South Asian countries. However, you must clear the FMGE (India), PMDC screening test (Pakistan), or respective licensing exams to practice in your home country.'],
            ['q' => 'What is the medium of instruction for MBBS in Europe?', 'a' => 'Most European countries (Poland, Hungary, Czech Republic, Romania, Latvia) offer English-medium MBBS programs specifically designed for international students. Germany has some English programs, but most require German language proficiency.'],
            ['q' => 'Do I need to clear NEET to study MBBS in Europe?', 'a' => 'Indian students must clear NEET to study MBBS abroad as per NMC regulations (from 2021). However, the specific NEET score requirement for European countries may be lower than what is needed for Indian medical colleges.'],
            ['q' => 'What is the duration of MBBS in European countries?', 'a' => 'The duration of MBBS (MD Program) in most European countries is 6 years. This includes 5 years of theoretical and clinical study, followed by 1 year of practical clinical internship at the university hospital.'],
            ['q' => 'Is it safe for international students to study in Europe?', 'a' => 'Yes, Europe is generally very safe for international students. Most European countries have large communities of Indian, Pakistani, Nepali, and African students. Universities have dedicated international student offices.'],
            ['q' => 'Are there any scholarships available for MBBS in Europe?', 'a' => 'Yes! Several universities offer merit-based scholarships and fee waivers for international students. EU governments also offer Erasmus+ scholarships. Contact our counselors to learn about current scholarship opportunities.'],
        ];

        $testimonials = [
            ['initials' => 'RS', 'name' => 'Riya Sharma', 'info' => 'MBBS 3rd Year, Jagiellonian University, Poland', 'text' => 'EuroMedStudy made my dream of studying medicine in Poland a reality. Their visa support and counselling was incredible. I am now in my 3rd year at Jagiellonian University!'],
            ['initials' => 'AK', 'name' => 'Ahmed Khan', 'info' => 'MBBS 2nd Year, Iuliu Hatieganu University, Romania', 'text' => 'The team at EuroMedStudy helped me choose Romania and now I am saving a lot compared to private medical colleges back home. Quality of education is top-notch!'],
            ['initials' => 'PM', 'name' => 'Priya Mehta', 'info' => 'MBBS 1st Year, Semmelweis University, Hungary', 'text' => 'Getting into Semmelweis University in Hungary was a dream come true. The counsellors guided me through every step. Highly recommend EuroMedStudy to all medical aspirants!'],
            ['initials' => 'SK', 'name' => 'Suresh Kumar', 'info' => 'MBBS 4th Year, Charles University, Czech Republic', 'text' => 'I was worried about studying abroad but EuroMedStudy\'s support from day one made everything smooth. Charles University Prague is an amazing place to study medicine!'],
        ];

        return view('home', compact('countries', 'universities', 'fees', 'faqs', 'testimonials'));
    }
}

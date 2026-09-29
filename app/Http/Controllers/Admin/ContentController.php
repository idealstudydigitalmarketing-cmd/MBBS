<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Enquiry, SiteSetting, Country, University, Testimonial, BlogPost};
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ContentController extends Controller
{
    // ════════════════════════════════════════════
    // SITE SETTINGS
    // ════════════════════════════════════════════

    public function settings()
    {
        $settings = SiteSetting::orderBy('group')->orderBy('sort_order')->get()->groupBy('group');
        return view('admin.settings', compact('settings'));
    }

    public function settingsSave(Request $request)
    {
        foreach ($request->except(['_token', '_method']) as $key => $value) {
            SiteSetting::where('key', $key)->update(['value' => $value]);
        }
        return back()->with('success', 'Settings saved successfully.');
    }

    // ════════════════════════════════════════════
    // COUNTRIES
    // ════════════════════════════════════════════

    public function countries()
    {
        $countries = Country::orderBy('sort_order')->get();
        return view('admin.countries.index', compact('countries'));
    }

    public function countryCreate()
    {
        return view('admin.countries.form', ['country' => null]);
    }

    public function countryStore(Request $request)
    {
        $data = $request->validate([
            'slug'             => 'required|unique:countries,slug|alpha_dash',
            'name'             => 'required|string|max:100',
            'flag_emoji'       => 'required|string|max:10',
            'tagline'          => 'required|string|max:200',
            'description'      => 'required|string',
            'duration'         => 'required|string',
            'language'         => 'required|string',
            'tuition_range'    => 'required|string',
            'living_cost_range'=> 'required|string',
            'total_cost'       => 'required|string',
            'intake_month'     => 'required|string',
            'min_marks'        => 'required|string',
            'entrance_exam'    => 'required|string',
            'sort_order'       => 'integer',
        ]);
        $data['nmc_approved']  = $request->boolean('nmc_approved');
        $data['usmle_track']   = $request->boolean('usmle_track');
        $data['neet_required'] = $request->boolean('neet_required');
        $data['is_active']     = $request->boolean('is_active', true);

        if ($request->hasFile('image')) {
            $data['image_path'] = 'assets/' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(base_path('assets'), $request->file('image')->getClientOriginalName());
        }

        Country::create($data);
        return redirect()->route('admin.countries')->with('success', 'Country added successfully.');
    }

    public function countryEdit(Country $country)
    {
        return view('admin.countries.form', compact('country'));
    }

    public function countryUpdate(Request $request, Country $country)
    {
        $data = $request->validate([
            'name'             => 'required|string|max:100',
            'flag_emoji'       => 'required|string|max:10',
            'tagline'          => 'required|string|max:200',
            'description'      => 'required|string',
            'duration'         => 'required|string',
            'language'         => 'required|string',
            'tuition_range'    => 'required|string',
            'living_cost_range'=> 'required|string',
            'total_cost'       => 'required|string',
            'intake_month'     => 'required|string',
            'min_marks'        => 'required|string',
            'entrance_exam'    => 'required|string',
            'sort_order'       => 'integer',
        ]);
        $data['nmc_approved']  = $request->boolean('nmc_approved');
        $data['usmle_track']   = $request->boolean('usmle_track');
        $data['neet_required'] = $request->boolean('neet_required');
        $data['is_active']     = $request->boolean('is_active', true);

        if ($request->hasFile('image')) {
            $data['image_path'] = 'assets/' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(base_path('assets'), $request->file('image')->getClientOriginalName());
        }

        $country->update($data);
        return redirect()->route('admin.countries')->with('success', 'Country updated successfully.');
    }

    public function countryDestroy(Country $country)
    {
        $country->delete();
        return back()->with('success', 'Country deleted.');
    }

    // ════════════════════════════════════════════
    // UNIVERSITIES
    // ════════════════════════════════════════════

    public function universities()
    {
        $universities = University::orderBy('sort_order')->get();
        $countries    = Country::orderBy('sort_order')->pluck('name', 'slug');
        return view('admin.universities.index', compact('universities', 'countries'));
    }

    public function universityCreate()
    {
        $countries = Country::orderBy('sort_order')->pluck('name', 'slug');
        return view('admin.universities.form', ['university' => null, 'countries' => $countries]);
    }

    public function universityStore(Request $request)
    {
        $data = $request->validate([
            'name'         => 'required|string|max:200',
            'city'         => 'required|string|max:100',
            'country_slug' => 'required|string',
            'flag_emoji'   => 'required|string|max:10',
            'rank'         => 'integer',
            'annual_fee'   => 'required|string',
            'description'  => 'nullable|string',
            'established'  => 'nullable|string',
            'language'     => 'required|string',
            'sort_order'   => 'integer',
        ]);
        $data['who_approved'] = $request->boolean('who_approved');
        $data['nmc_listed']   = $request->boolean('nmc_listed');
        $data['usmle_track']  = $request->boolean('usmle_track');
        $data['is_active']    = $request->boolean('is_active', true);

        // Parse tags from comma-separated string
        if ($request->filled('tags_raw')) {
            $tags = array_filter(array_map('trim', explode(',', $request->tags_raw)));
            $data['tags'] = json_encode(array_values($tags));
        }

        University::create($data);
        return redirect()->route('admin.universities')->with('success', 'University added.');
    }

    public function universityEdit(University $university)
    {
        $countries = Country::orderBy('sort_order')->pluck('name', 'slug');
        return view('admin.universities.form', compact('university', 'countries'));
    }

    public function universityUpdate(Request $request, University $university)
    {
        $data = $request->validate([
            'name'         => 'required|string|max:200',
            'city'         => 'required|string|max:100',
            'country_slug' => 'required|string',
            'flag_emoji'   => 'required|string|max:10',
            'rank'         => 'integer',
            'annual_fee'   => 'required|string',
            'description'  => 'nullable|string',
            'established'  => 'nullable|string',
            'language'     => 'required|string',
            'sort_order'   => 'integer',
        ]);
        $data['who_approved'] = $request->boolean('who_approved');
        $data['nmc_listed']   = $request->boolean('nmc_listed');
        $data['usmle_track']  = $request->boolean('usmle_track');
        $data['is_active']    = $request->boolean('is_active', true);

        if ($request->filled('tags_raw')) {
            $tags = array_filter(array_map('trim', explode(',', $request->tags_raw)));
            $data['tags'] = json_encode(array_values($tags));
        }

        $university->update($data);
        return redirect()->route('admin.universities')->with('success', 'University updated.');
    }

    public function universityDestroy(University $university)
    {
        $university->delete();
        return back()->with('success', 'University deleted.');
    }

    // ════════════════════════════════════════════
    // TESTIMONIALS
    // ════════════════════════════════════════════

    public function testimonials()
    {
        $testimonials = Testimonial::orderBy('sort_order')->get();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function testimonialCreate()
    {
        $countries = Country::orderBy('sort_order')->pluck('name', 'slug');
        return view('admin.testimonials.form', ['testimonial' => null, 'countries' => $countries]);
    }

    public function testimonialStore(Request $request)
    {
        $data = $request->validate([
            'name'           => 'required|string|max:100',
            'university'     => 'required|string|max:200',
            'country_slug'   => 'nullable|string',
            'flag_emoji'     => 'nullable|string|max:10',
            'year_batch'     => 'nullable|string|max:100',
            'quote'          => 'required|string',
            'stars'          => 'integer|min:1|max:5',
            'avatar_initials'=> 'nullable|string|max:5',
            'sort_order'     => 'integer',
        ]);
        $data['is_active'] = $request->boolean('is_active', true);
        Testimonial::create($data);
        return redirect()->route('admin.testimonials')->with('success', 'Testimonial added.');
    }

    public function testimonialEdit(Testimonial $testimonial)
    {
        $countries = Country::orderBy('sort_order')->pluck('name', 'slug');
        return view('admin.testimonials.form', compact('testimonial', 'countries'));
    }

    public function testimonialUpdate(Request $request, Testimonial $testimonial)
    {
        $data = $request->validate([
            'name'           => 'required|string|max:100',
            'university'     => 'required|string|max:200',
            'country_slug'   => 'nullable|string',
            'flag_emoji'     => 'nullable|string|max:10',
            'year_batch'     => 'nullable|string|max:100',
            'quote'          => 'required|string',
            'stars'          => 'integer|min:1|max:5',
            'avatar_initials'=> 'nullable|string|max:5',
            'sort_order'     => 'integer',
        ]);
        $data['is_active'] = $request->boolean('is_active', true);
        $testimonial->update($data);
        return redirect()->route('admin.testimonials')->with('success', 'Testimonial updated.');
    }

    public function testimonialDestroy(Testimonial $testimonial)
    {
        $testimonial->delete();
        return back()->with('success', 'Testimonial deleted.');
    }

    // ════════════════════════════════════════════
    // BLOG POSTS
    // ════════════════════════════════════════════

    public function blog()
    {
        $posts = BlogPost::orderByDesc('created_at')->get();
        return view('admin.blog.index', compact('posts'));
    }

    public function blogCreate()
    {
        return view('admin.blog.form', ['post' => null]);
    }

    public function blogStore(Request $request)
    {
        $data = $request->validate([
            'title'            => 'required|string|max:255',
            'slug'             => 'nullable|string|max:255',
            'category'         => 'required|string|max:100',
            'author'           => 'required|string|max:100',
            'read_time'        => 'required|string|max:50',
            'excerpt'          => 'required|string|max:500',
            'content'          => 'required|string',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'sort_order'       => 'integer',
        ]);

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }
        $data['is_published'] = $request->boolean('is_published');
        if ($data['is_published']) {
            $data['published_at'] = now();
        }

        BlogPost::create($data);
        return redirect()->route('admin.blog')->with('success', 'Blog post created.');
    }

    public function blogEdit(BlogPost $post)
    {
        return view('admin.blog.form', compact('post'));
    }

    public function blogUpdate(Request $request, BlogPost $post)
    {
        $data = $request->validate([
            'title'            => 'required|string|max:255',
            'slug'             => 'nullable|string|max:255',
            'category'         => 'required|string|max:100',
            'author'           => 'required|string|max:100',
            'read_time'        => 'required|string|max:50',
            'excerpt'          => 'required|string|max:500',
            'content'          => 'required|string',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'sort_order'       => 'integer',
        ]);

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }
        $data['is_published'] = $request->boolean('is_published');
        if ($data['is_published'] && !$post->published_at) {
            $data['published_at'] = now();
        }

        $post->update($data);
        return redirect()->route('admin.blog')->with('success', 'Blog post updated.');
    }

    public function blogDestroy(BlogPost $post)
    {
        $post->delete();
        return back()->with('success', 'Blog post deleted.');
    }

    // ════════════════════════════════════════════
    // ENQUIRIES CSV EXPORT
    // ════════════════════════════════════════════

    public function exportEnquiries()
    {
        $enquiries = Enquiry::latest()->get();

        $filename = 'enquiries_' . now()->format('Y-m-d_His') . '.csv';
        $headers  = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($enquiries) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', 'Name', 'Email', 'Phone', 'Country', 'Qualification', 'Message', 'Status', 'IP Address', 'Date']);
            foreach ($enquiries as $e) {
                fputcsv($file, [
                    $e->id, $e->full_name, $e->email, $e->phone,
                    $e->country_label, $e->qualification, $e->message,
                    $e->status, $e->ip_address,
                    $e->created_at->format('d M Y H:i'),
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}

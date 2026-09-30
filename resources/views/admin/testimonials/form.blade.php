@extends('admin.layout')
@section('admin-title', $testimonial ? 'Edit Testimonial' : 'Add Testimonial')

@section('admin-content')
<div class="page-header">
  <div>
    <h1>{{ $testimonial ? '✏️ Edit Testimonial' : '⭐ Add Testimonial' }}</h1>
  </div>
  <div class="page-header-actions">
    <a href="{{ route('admin.testimonials') }}" class="btn btn-secondary">← Back</a>
  </div>
</div>

<form method="POST" action="{{ $testimonial ? route('admin.testimonials.update', $testimonial) : route('admin.testimonials.store') }}">
  @csrf @if($testimonial) @method('PUT') @endif

  <div style="display:grid;grid-template-columns:2fr 1fr;gap:24px;align-items:start;">
    <div class="card">
      <div class="card-header"><h3>👤 Student Information</h3></div>
      <div class="card-body">
        <div class="form-grid form-grid-2">
          <div class="form-group">
            <label>Student Full Name *</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $testimonial?->name) }}" required placeholder="e.g. Riya Sharma"/>
          </div>
          <div class="form-group">
            <label>Avatar Initials</label>
            <input type="text" name="avatar_initials" class="form-control" value="{{ old('avatar_initials', $testimonial?->avatar_initials) }}" maxlength="3" placeholder="RS"/>
            <span class="help-text">2–3 letters shown in the avatar circle</span>
          </div>
          <div class="form-group">
            <label>University Name *</label>
            <input type="text" name="university" class="form-control" value="{{ old('university', $testimonial?->university) }}" required placeholder="e.g. Jagiellonian University"/>
          </div>
          <div class="form-group">
            <label>Year / Batch</label>
            <input type="text" name="year_batch" class="form-control" value="{{ old('year_batch', $testimonial?->year_batch) }}" placeholder="e.g. MBBS 3rd Year"/>
          </div>
          <div class="form-group">
            <label>Country</label>
            <select name="country_slug" class="form-control">
              <option value="">— Select —</option>
              @foreach($countries as $slug => $name)
              <option value="{{ $slug }}" {{ old('country_slug', $testimonial?->country_slug) == $slug ? 'selected' : '' }}>{{ $name }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label>Flag Emoji</label>
            <input type="text" name="flag_emoji" class="form-control" value="{{ old('flag_emoji', $testimonial?->flag_emoji) }}" maxlength="5" placeholder="🇵🇱"/>
          </div>
          <div class="form-group" style="grid-column:1/-1;">
            <label>Testimonial Quote *</label>
            <textarea name="quote" class="form-control" rows="4" required placeholder="What did the student say about EuroMedStudy?">{{ old('quote', $testimonial?->quote) }}</textarea>
          </div>
          <div class="form-group">
            <label>Star Rating</label>
            <select name="stars" class="form-control">
              @for($i=5;$i>=1;$i--)
              <option value="{{ $i }}" {{ old('stars', $testimonial?->stars ?? 5) == $i ? 'selected' : '' }}>{{ str_repeat('★', $i) }}</option>
              @endfor
            </select>
          </div>
        </div>
      </div>
    </div>

    <div style="display:flex;flex-direction:column;gap:20px;">
      <div class="card">
        <div class="card-header"><h3>📋 Display</h3></div>
        <div class="card-body" style="display:flex;flex-direction:column;gap:14px;">
          <label class="form-check">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $testimonial?->is_active ?? true) ? 'checked' : '' }}/>
            <label>Show in Carousel</label>
          </label>
          <div class="form-group">
            <label>Sort Order</label>
            <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $testimonial?->sort_order ?? 0) }}" min="0"/>
          </div>
        </div>
      </div>
      <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;">
        💾 {{ $testimonial ? 'Update' : 'Add Testimonial' }}
      </button>
    </div>
  </div>
</form>
@endsection

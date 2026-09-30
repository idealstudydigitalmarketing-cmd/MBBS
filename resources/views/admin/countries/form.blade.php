@extends('admin.layout')
@section('admin-title', $country ? 'Edit Country' : 'Add Country')

@section('admin-content')
<div class="page-header">
  <div>
    <h1>{{ $country ? '✏️ Edit Country: '.$country->name : '🌍 Add New Country' }}</h1>
    <p>Fill in all fields to {{ $country ? 'update' : 'add' }} a destination country.</p>
  </div>
  <div class="page-header-actions">
    <a href="{{ route('admin.countries') }}" class="btn btn-secondary">← Back to Countries</a>
  </div>
</div>

<form method="POST" action="{{ $country ? route('admin.countries.update', $country) : route('admin.countries.store') }}" enctype="multipart/form-data">
  @csrf
  @if($country) @method('PUT') @endif

  <div style="display:grid;grid-template-columns:2fr 1fr;gap:24px;align-items:start;">

    <!-- LEFT: Main Details -->
    <div style="display:flex;flex-direction:column;gap:20px;">
      <div class="card">
        <div class="card-header"><h3>🌐 Basic Information</h3></div>
        <div class="card-body">
          <div class="form-grid form-grid-2">
            <div class="form-group">
              <label>Country Name *</label>
              <input type="text" name="name" class="form-control" value="{{ old('name', $country?->name) }}" required placeholder="e.g. Poland"/>
            </div>
            <div class="form-group">
              <label>URL Slug *</label>
              <input type="text" name="slug" class="form-control" value="{{ old('slug', $country?->slug) }}" {{ $country ? 'readonly' : 'required' }} placeholder="e.g. poland"/>
              <span class="help-text">Lowercase, no spaces. Cannot be changed after creation.</span>
            </div>
            <div class="form-group">
              <label>Flag Emoji *</label>
              <input type="text" name="flag_emoji" class="form-control" value="{{ old('flag_emoji', $country?->flag_emoji) }}" required placeholder="🇵🇱"/>
            </div>
            <div class="form-group">
              <label>Tagline *</label>
              <input type="text" name="tagline" class="form-control" value="{{ old('tagline', $country?->tagline) }}" required placeholder="e.g. Most Popular MBBS Destination"/>
            </div>
            <div class="form-group" style="grid-column:1/-1;">
              <label>Description *</label>
              <textarea name="description" class="form-control" rows="4" required>{{ old('description', $country?->description) }}</textarea>
            </div>
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-header"><h3>💰 Fees & Program Details</h3></div>
        <div class="card-body">
          <div class="form-grid form-grid-2">
            <div class="form-group">
              <label>Duration *</label>
              <input type="text" name="duration" class="form-control" value="{{ old('duration', $country?->duration ?? '6 Years (MD)') }}" required/>
            </div>
            <div class="form-group">
              <label>Language of Instruction *</label>
              <input type="text" name="language" class="form-control" value="{{ old('language', $country?->language ?? 'English') }}" required/>
            </div>
            <div class="form-group">
              <label>Annual Tuition Range *</label>
              <input type="text" name="tuition_range" class="form-control" value="{{ old('tuition_range', $country?->tuition_range) }}" required placeholder="€6,000 – €8,000"/>
            </div>
            <div class="form-group">
              <label>Living Cost / Month *</label>
              <input type="text" name="living_cost_range" class="form-control" value="{{ old('living_cost_range', $country?->living_cost_range) }}" required placeholder="€500 – €700"/>
            </div>
            <div class="form-group">
              <label>Total 6-Year Cost *</label>
              <input type="text" name="total_cost" class="form-control" value="{{ old('total_cost', $country?->total_cost) }}" required placeholder="~€85,000"/>
            </div>
            <div class="form-group">
              <label>Intake Month *</label>
              <input type="text" name="intake_month" class="form-control" value="{{ old('intake_month', $country?->intake_month) }}" required placeholder="October"/>
            </div>
            <div class="form-group">
              <label>Minimum Marks *</label>
              <input type="text" name="min_marks" class="form-control" value="{{ old('min_marks', $country?->min_marks ?? '50% in PCB') }}" required/>
            </div>
            <div class="form-group">
              <label>Entrance Exam *</label>
              <input type="text" name="entrance_exam" class="form-control" value="{{ old('entrance_exam', $country?->entrance_exam ?? 'Biology/Chemistry') }}" required/>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- RIGHT: Meta & Status -->
    <div style="display:flex;flex-direction:column;gap:20px;">
      <div class="card">
        <div class="card-header"><h3>✅ Accreditations</h3></div>
        <div class="card-body" style="display:flex;flex-direction:column;gap:14px;">
          <label class="form-check">
            <input type="checkbox" name="nmc_approved" value="1" {{ old('nmc_approved', $country?->nmc_approved) ? 'checked' : '' }}/>
            <label>NMC / WHO Approved</label>
          </label>
          <label class="form-check">
            <input type="checkbox" name="usmle_track" value="1" {{ old('usmle_track', $country?->usmle_track) ? 'checked' : '' }}/>
            <label>USMLE Track Available</label>
          </label>
          <label class="form-check">
            <input type="checkbox" name="neet_required" value="1" {{ old('neet_required', $country?->neet_required ?? true) ? 'checked' : '' }}/>
            <label>NEET Required (India)</label>
          </label>
        </div>
      </div>

      <div class="card">
        <div class="card-header"><h3>🖼️ Country Image</h3></div>
        <div class="card-body">
          @if($country?->image_path)
          <img src="{{ asset($country->image_path) }}" alt="{{ $country->name }}" style="width:100%;height:140px;object-fit:cover;border-radius:8px;margin-bottom:10px;"/>
          @endif
          <div class="form-group">
            <label>Upload New Image</label>
            <input type="file" name="image" class="form-control" accept="image/*"/>
            <span class="help-text">JPG or PNG. Will be saved to /assets/</span>
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-header"><h3>📋 Display Options</h3></div>
        <div class="card-body" style="display:flex;flex-direction:column;gap:14px;">
          <label class="form-check">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $country?->is_active ?? true) ? 'checked' : '' }}/>
            <label>Show on Website</label>
          </label>
          <div class="form-group">
            <label>Sort Order</label>
            <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $country?->sort_order ?? 0) }}" min="0"/>
            <span class="help-text">Lower number = shows first</span>
          </div>
        </div>
      </div>

      <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;">
        💾 {{ $country ? 'Update Country' : 'Add Country' }}
      </button>
    </div>

  </div>
</form>
@endsection

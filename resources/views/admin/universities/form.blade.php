@extends('admin.layout')
@section('admin-title', $university ? 'Edit University' : 'Add University')

@section('admin-content')
<div class="page-header">
  <div>
    <h1>{{ $university ? '✏️ Edit: '.$university->name : '🏛️ Add New University' }}</h1>
  </div>
  <div class="page-header-actions">
    <a href="{{ route('admin.universities') }}" class="btn btn-secondary">← Back</a>
  </div>
</div>

<form method="POST" action="{{ $university ? route('admin.universities.update', $university) : route('admin.universities.store') }}">
  @csrf @if($university) @method('PUT') @endif

  <div style="display:grid;grid-template-columns:2fr 1fr;gap:24px;align-items:start;">
    <div style="display:flex;flex-direction:column;gap:20px;">
      <div class="card">
        <div class="card-header"><h3>🏛️ University Details</h3></div>
        <div class="card-body">
          <div class="form-grid form-grid-2">
            <div class="form-group" style="grid-column:1/-1;">
              <label>University Name *</label>
              <input type="text" name="name" class="form-control" value="{{ old('name', $university?->name) }}" required placeholder="e.g. Jagiellonian University Medical College"/>
            </div>
            <div class="form-group">
              <label>City *</label>
              <input type="text" name="city" class="form-control" value="{{ old('city', $university?->city) }}" required placeholder="e.g. Kraków"/>
            </div>
            <div class="form-group">
              <label>Flag Emoji *</label>
              <input type="text" name="flag_emoji" class="form-control" value="{{ old('flag_emoji', $university?->flag_emoji) }}" required placeholder="🇵🇱"/>
            </div>
            <div class="form-group">
              <label>Country *</label>
              <select name="country_slug" class="form-control" required>
                <option value="">— Select Country —</option>
                @foreach($countries as $slug => $name)
                <option value="{{ $slug }}" {{ old('country_slug', $university?->country_slug) == $slug ? 'selected' : '' }}>{{ $name }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label>Annual Fee *</label>
              <input type="text" name="annual_fee" class="form-control" value="{{ old('annual_fee', $university?->annual_fee) }}" required placeholder="From €9,500/yr"/>
            </div>
            <div class="form-group">
              <label>Year Established</label>
              <input type="text" name="established" class="form-control" value="{{ old('established', $university?->established) }}" placeholder="e.g. 1364"/>
            </div>
            <div class="form-group">
              <label>Language</label>
              <input type="text" name="language" class="form-control" value="{{ old('language', $university?->language ?? 'English') }}" required/>
            </div>
            <div class="form-group">
              <label>Rank</label>
              <input type="number" name="rank" class="form-control" value="{{ old('rank', $university?->rank) }}" min="0"/>
            </div>
            <div class="form-group" style="grid-column:1/-1;">
              <label>Tags (comma-separated)</label>
              <input type="text" name="tags_raw" class="form-control"
                value="{{ old('tags_raw', $university ? implode(', ', $university->tags_array) : '') }}"
                placeholder="WHO Recognized, NMC Approved, English"/>
              <span class="help-text">These appear as small badge chips on the university card.</span>
            </div>
            <div class="form-group" style="grid-column:1/-1;">
              <label>Description</label>
              <textarea name="description" class="form-control" rows="3">{{ old('description', $university?->description) }}</textarea>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div style="display:flex;flex-direction:column;gap:20px;">
      <div class="card">
        <div class="card-header"><h3>✅ Accreditations</h3></div>
        <div class="card-body" style="display:flex;flex-direction:column;gap:14px;">
          <label class="form-check">
            <input type="checkbox" name="who_approved" value="1" {{ old('who_approved', $university?->who_approved ?? true) ? 'checked' : '' }}/>
            <label>WHO Approved</label>
          </label>
          <label class="form-check">
            <input type="checkbox" name="nmc_listed" value="1" {{ old('nmc_listed', $university?->nmc_listed ?? true) ? 'checked' : '' }}/>
            <label>NMC Listed</label>
          </label>
          <label class="form-check">
            <input type="checkbox" name="usmle_track" value="1" {{ old('usmle_track', $university?->usmle_track) ? 'checked' : '' }}/>
            <label>USMLE Track</label>
          </label>
        </div>
      </div>

      <div class="card">
        <div class="card-header"><h3>📋 Display Options</h3></div>
        <div class="card-body" style="display:flex;flex-direction:column;gap:14px;">
          <label class="form-check">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $university?->is_active ?? true) ? 'checked' : '' }}/>
            <label>Show on Website</label>
          </label>
          <div class="form-group">
            <label>Sort Order</label>
            <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $university?->sort_order ?? 0) }}" min="0"/>
          </div>
        </div>
      </div>

      <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;">
        💾 {{ $university ? 'Update University' : 'Add University' }}
      </button>
    </div>
  </div>
</form>
@endsection

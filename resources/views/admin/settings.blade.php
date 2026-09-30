@extends('admin.layout')
@section('admin-title', 'Site Settings')

@section('admin-content')
<div class="page-header">
  <div>
    <h1>⚙️ Site Settings</h1>
    <p>Edit your website's text, contact info, SEO and more — no code needed.</p>
  </div>
</div>

<form method="POST" action="{{ route('admin.settings.save') }}">
  @csrf

  @php
    $groupLabels = [
      'hero'    => ['icon'=>'🎯', 'label'=>'Hero Section'],
      'stats'   => ['icon'=>'📊', 'label'=>'Statistics Bar'],
      'about'   => ['icon'=>'ℹ️',  'label'=>'About / Expertise Section'],
      'cta'     => ['icon'=>'📢', 'label'=>'CTA Banner'],
      'contact' => ['icon'=>'📞', 'label'=>'Contact Details'],
      'seo'     => ['icon'=>'🔍', 'label'=>'SEO / Meta Tags'],
    ];
  @endphp

  @foreach($settings as $group => $items)
  <div class="settings-group card" style="margin-bottom:24px;">
    <div class="card-header">
      <div class="settings-group-header" style="margin:0;padding:0;border:none;">
        <span class="settings-group-icon">{{ $groupLabels[$group]['icon'] ?? '📌' }}</span>
        <h3>{{ $groupLabels[$group]['label'] ?? ucfirst($group) }}</h3>
      </div>
    </div>
    <div class="card-body">
      <div class="form-grid form-grid-2">
        @foreach($items as $setting)
        <div class="form-group {{ $setting['type'] === 'textarea' ? 'form-grid-colspan' : '' }}" style="{{ $setting['type'] === 'textarea' ? 'grid-column:1/-1;' : '' }}">
          <label for="setting_{{ $setting['key'] }}">{{ $setting['label'] }}</label>
          @if($setting['type'] === 'textarea')
            <textarea
              id="setting_{{ $setting['key'] }}"
              name="{{ $setting['key'] }}"
              class="form-control"
              rows="3"
            >{{ $setting['value'] }}</textarea>
          @else
            <input
              type="text"
              id="setting_{{ $setting['key'] }}"
              name="{{ $setting['key'] }}"
              value="{{ $setting['value'] }}"
              class="form-control"
            />
          @endif
          <span class="help-text">Key: <code>{{ $setting['key'] }}</code></span>
        </div>
        @endforeach
      </div>
    </div>
  </div>
  @endforeach

  <div style="position:sticky;bottom:20px;z-index:50;">
    <div class="card" style="padding:16px 24px;display:flex;align-items:center;justify-content:space-between;background:#fff;box-shadow:0 -4px 20px rgba(0,0,0,0.08);">
      <span style="font-size:0.85rem;color:var(--clr-muted);">Changes take effect immediately on your live website.</span>
      <button type="submit" class="btn btn-primary">💾 Save All Settings</button>
    </div>
  </div>
</form>
@endsection

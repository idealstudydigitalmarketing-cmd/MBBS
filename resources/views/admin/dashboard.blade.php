@extends('admin.layout')
@section('admin-title', 'Dashboard')

@section('admin-content')
<div class="page-header">
  <div>
    <h1>📊 Dashboard</h1>
    <p>Welcome back, Administrator. Here's an overview of your website content and leads.</p>
  </div>
  <div class="page-header-actions">
    <a href="{{ route('admin.enquiries.export') }}" class="btn btn-secondary">📥 Export CSV</a>
    <a href="{{ route('home') }}" class="btn btn-primary" target="_blank">🌐 View Website</a>
  </div>
</div>

<!-- ── ENQUIRY STATS ── -->
<p style="font-size:0.72rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:var(--clr-muted);margin-bottom:12px;">Lead Enquiries</p>
<div class="stats-grid" style="margin-bottom:32px;">
  <div class="stat-card blue">
    <div class="stat-card-top">
      <div class="stat-icon">📩</div>
      <span style="font-size:0.72rem;color:var(--clr-muted);font-weight:600;">Total</span>
    </div>
    <div class="stat-num">{{ $stats['total'] }}</div>
    <div class="stat-label">All Enquiries</div>
  </div>
  <div class="stat-card red">
    <div class="stat-card-top">
      <div class="stat-icon">🔔</div>
      <span style="font-size:0.72rem;color:var(--clr-muted);font-weight:600;">Unread</span>
    </div>
    <div class="stat-num">{{ $stats['new'] }}</div>
    <div class="stat-label">New / Unread</div>
  </div>
  <div class="stat-card amber">
    <div class="stat-card-top">
      <div class="stat-icon">📞</div>
      <span style="font-size:0.72rem;color:var(--clr-muted);font-weight:600;">In Progress</span>
    </div>
    <div class="stat-num">{{ $stats['contacted'] }}</div>
    <div class="stat-label">Contacted</div>
  </div>
  <div class="stat-card green">
    <div class="stat-card-top">
      <div class="stat-icon">🎓</div>
      <span style="font-size:0.72rem;color:var(--clr-muted);font-weight:600;">Closed</span>
    </div>
    <div class="stat-num">{{ $stats['enrolled'] }}</div>
    <div class="stat-label">Enrolled</div>
  </div>
  <div class="stat-card purple">
    <div class="stat-card-top">
      <div class="stat-icon">📅</div>
      <span style="font-size:0.72rem;color:var(--clr-muted);font-weight:600;">Today</span>
    </div>
    <div class="stat-num">{{ $stats['today'] }}</div>
    <div class="stat-label">Today's Leads</div>
  </div>
</div>

<!-- ── CONTENT STATS ── -->
<p style="font-size:0.72rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:var(--clr-muted);margin-bottom:12px;">Website Content</p>
<div class="stats-grid" style="grid-template-columns:repeat(4,1fr);margin-bottom:32px;">
  @php
    $contentStats = [
      ['icon'=>'🌍', 'count'=> \App\Models\Country::count(),     'label'=>'Countries',    'link'=> route('admin.countries'),    'color'=>'blue'],
      ['icon'=>'🏛️', 'count'=> \App\Models\University::count(),  'label'=>'Universities', 'link'=> route('admin.universities'), 'color'=>'green'],
      ['icon'=>'⭐', 'count'=> \App\Models\Testimonial::count(), 'label'=>'Testimonials', 'link'=> route('admin.testimonials'), 'color'=>'amber'],
      ['icon'=>'📝', 'count'=> \App\Models\BlogPost::count(),    'label'=>'Blog Posts',   'link'=> route('admin.blog'),         'color'=>'purple'],
    ];
  @endphp
  @foreach($contentStats as $cs)
  <a href="{{ $cs['link'] }}" style="text-decoration:none;">
    <div class="stat-card {{ $cs['color'] }}" style="cursor:pointer;">
      <div class="stat-card-top">
        <div class="stat-icon">{{ $cs['icon'] }}</div>
        <span style="font-size:0.72rem;color:var(--clr-muted);font-weight:600;">Manage →</span>
      </div>
      <div class="stat-num">{{ $cs['count'] }}</div>
      <div class="stat-label">{{ $cs['label'] }}</div>
    </div>
  </a>
  @endforeach
</div>

<!-- ── QUICK ACTIONS ── -->
<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:32px;">
  @foreach([
    ['href'=> route('admin.settings'),          'icon'=>'⚙️', 'label'=>'Edit Site Settings'],
    ['href'=> route('admin.countries.create'),  'icon'=>'🌍', 'label'=>'Add Country'],
    ['href'=> route('admin.universities.create'),'icon'=>'🏛️','label'=>'Add University'],
    ['href'=> route('admin.blog.create'),        'icon'=>'📝', 'label'=>'Write Blog Post'],
  ] as $qa)
  <a href="{{ $qa['href'] }}" class="card" style="text-decoration:none;padding:16px 20px;display:flex;align-items:center;gap:12px;transition:all 0.2s;border-left:3px solid var(--clr-blue);">
    <span style="font-size:1.5rem;">{{ $qa['icon'] }}</span>
    <span style="font-size:0.87rem;font-weight:700;color:var(--clr-text);">{{ $qa['label'] }}</span>
  </a>
  @endforeach
</div>

<!-- ── RECENT ENQUIRIES TABLE ── -->
<div class="card">
  <div class="card-header">
    <h3>📩 Recent Enquiries</h3>
    <a href="{{ route('admin.enquiries') }}" class="btn btn-sm btn-secondary">View All →</a>
  </div>
  <div class="table-wrap">
    <table>
      <thead>
        <tr>
          <th>#</th><th>Name</th><th>Phone</th><th>Email</th>
          <th>Country</th><th>Status</th><th>Date</th><th>Action</th>
        </tr>
      </thead>
      <tbody>
        @forelse($recent as $e)
        <tr>
          <td>{{ $e->id }}</td>
          <td>{{ $e->full_name }}</td>
          <td>{{ $e->phone }}</td>
          <td>{{ $e->email }}</td>
          <td>{{ $e->country_label }}</td>
          <td>{!! $e->status_badge !!}</td>
          <td>{{ $e->created_at->format('d M Y') }}</td>
          <td>
            <a href="{{ route('admin.enquiries.show', $e->id) }}" class="btn btn-xs btn-secondary">View</a>
          </td>
        </tr>
        @empty
        <tr><td colspan="8"><div class="empty-state"><div class="empty-icon">📩</div><p>No enquiries yet.</p></div></td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection

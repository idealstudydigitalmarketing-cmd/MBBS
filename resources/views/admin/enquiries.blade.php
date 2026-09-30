@extends('admin.layout')
@section('admin-title', 'All Enquiries')

@section('admin-content')
<form method="GET" action="{{ route('admin.enquiries') }}">
  <div class="filters">
    <input type="text" name="search" placeholder="🔍 Search name, email, phone..." value="{{ request('search') }}"/>
    <select name="status">
      <option value="">All Status</option>
      <option value="new"       {{ request('status')=='new'?'selected':'' }}>New</option>
      <option value="read"      {{ request('status')=='read'?'selected':'' }}>Read</option>
      <option value="contacted" {{ request('status')=='contacted'?'selected':'' }}>Contacted</option>
      <option value="enrolled"  {{ request('status')=='enrolled'?'selected':'' }}>Enrolled</option>
      <option value="rejected"  {{ request('status')=='rejected'?'selected':'' }}>Rejected</option>
    </select>
    <select name="country">
      <option value="">All Countries</option>
      <option value="germany"   {{ request('country')=='germany'?'selected':'' }}>Germany</option>
      <option value="poland"    {{ request('country')=='poland'?'selected':'' }}>Poland</option>
      <option value="hungary"   {{ request('country')=='hungary'?'selected':'' }}>Hungary</option>
      <option value="czech"     {{ request('country')=='czech'?'selected':'' }}>Czech Republic</option>
      <option value="romania"   {{ request('country')=='romania'?'selected':'' }}>Romania</option>
      <option value="latvia"    {{ request('country')=='latvia'?'selected':'' }}>Latvia</option>
    </select>
    <button type="submit" class="btn-filter">Filter</button>
    <a href="{{ route('admin.enquiries') }}" style="padding:9px 14px;background:#f1f5f9;border-radius:10px;font-size:0.85rem;color:#64748b;font-weight:600;text-decoration:none;">Reset</a>
  </div>
</form>

<div class="table-card">
  <div class="table-header">
    <h3>📩 Enquiries ({{ $enquiries->total() }} total)</h3>
  </div>
  <table>
    <thead>
      <tr>
        <th>#</th><th>Name</th><th>Phone</th><th>Email</th><th>Country</th><th>Qualification</th><th>Status</th><th>Date</th><th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @forelse($enquiries as $e)
      <tr>
        <td>{{ $e->id }}</td>
        <td>{{ $e->full_name }}</td>
        <td><a href="tel:{{ $e->phone }}" style="color:#1a56e8;">{{ $e->phone }}</a></td>
        <td><a href="mailto:{{ $e->email }}" style="color:#1a56e8;">{{ $e->email }}</a></td>
        <td>{{ $e->country_label }}</td>
        <td>{{ $e->qualification ?? '—' }}</td>
        <td>{!! $e->status_badge !!}</td>
        <td>{{ $e->created_at->format('d M Y') }}<br><small style="color:#94a3b8;">{{ $e->created_at->format('h:i A') }}</small></td>
        <td>
          <div class="action-btns">
            <a href="{{ route('admin.enquiries.show', $e->id) }}" class="btn-action btn-view">View</a>
            <form method="POST" action="{{ route('admin.enquiries.destroy', $e->id) }}" onsubmit="return confirm('Delete this enquiry?')" style="display:inline;">
              @csrf @method('DELETE')
              <button type="submit" class="btn-action btn-del">Delete</button>
            </form>
          </div>
        </td>
      </tr>
      @empty
      <tr><td colspan="9" style="text-align:center;padding:40px;color:#94a3b8;">No enquiries found.</td></tr>
      @endforelse
    </tbody>
  </table>
  @if($enquiries->hasPages())
  <div class="pagi">
    {{ $enquiries->withQueryString()->links() }}
  </div>
  @endif
</div>
@endsection

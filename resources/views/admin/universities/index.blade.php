@extends('admin.layout')
@section('admin-title', 'Universities')

@section('admin-content')
<div class="page-header">
  <div>
    <h1>🏛️ Universities</h1>
    <p>Manage partner universities featured on your website.</p>
  </div>
  <div class="page-header-actions">
    <a href="{{ route('admin.universities.create') }}" class="btn btn-primary">+ Add University</a>
  </div>
</div>

<div class="card">
  <div class="table-wrap">
    <table>
      <thead>
        <tr>
          <th>Rank</th>
          <th>University</th>
          <th>Country</th>
          <th>Annual Fee</th>
          <th>WHO</th>
          <th>NMC</th>
          <th>USMLE</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($universities as $u)
        <tr>
          <td style="font-family:monospace;font-weight:700;color:var(--clr-blue);">#{{ $u->rank }}</td>
          <td>
            <div style="font-weight:700;">{{ $u->flag_emoji }} {{ $u->name }}</div>
            <div style="font-size:0.75rem;color:var(--clr-muted);">📍 {{ $u->city }}</div>
          </td>
          <td>{{ $countries[$u->country_slug] ?? $u->country_slug }}</td>
          <td>{{ $u->annual_fee }}</td>
          <td>{!! $u->who_approved ? '<span class="badge badge-active">✓</span>' : '<span class="badge badge-inactive">✗</span>' !!}</td>
          <td>{!! $u->nmc_listed   ? '<span class="badge badge-active">✓</span>' : '<span class="badge badge-inactive">✗</span>' !!}</td>
          <td>{!! $u->usmle_track  ? '<span class="badge badge-active">✓</span>' : '<span class="badge badge-inactive">✗</span>' !!}</td>
          <td>{!! $u->is_active ? '<span class="badge badge-active">Active</span>' : '<span class="badge badge-inactive">Hidden</span>' !!}</td>
          <td>
            <div class="action-row">
              <a href="{{ route('admin.universities.edit', $u) }}" class="btn btn-sm btn-secondary">✏️ Edit</a>
              <form method="POST" action="{{ route('admin.universities.destroy', $u) }}" onsubmit="return confirm('Delete this university?')">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">🗑</button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr><td colspan="9"><div class="empty-state"><div class="empty-icon">🏛️</div><p>No universities added yet.</p></div></td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection

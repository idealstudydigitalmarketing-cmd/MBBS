@extends('admin.layout')
@section('admin-title', 'Countries')

@section('admin-content')
<div class="page-header">
  <div>
    <h1>🌍 Countries</h1>
    <p>Manage all MBBS destination countries shown on your website.</p>
  </div>
  <div class="page-header-actions">
    <a href="{{ route('admin.countries.create') }}" class="btn btn-primary">+ Add Country</a>
  </div>
</div>

<div class="card">
  <div class="table-wrap">
    <table>
      <thead>
        <tr>
          <th>Order</th>
          <th>Country</th>
          <th>Tuition / Year</th>
          <th>Language</th>
          <th>Intake</th>
          <th>NMC</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($countries as $c)
        <tr>
          <td style="color:var(--clr-muted);">{{ $c->sort_order }}</td>
          <td>
            <span style="font-size:1.3rem;">{{ $c->flag_emoji }}</span>
            <strong style="margin-left:8px;">{{ $c->name }}</strong>
            <div style="font-size:0.75rem;color:var(--clr-muted);">{{ $c->tagline }}</div>
          </td>
          <td>{{ $c->tuition_range }}</td>
          <td>{{ $c->language }}</td>
          <td>{{ $c->intake_month }}</td>
          <td>{!! $c->nmc_approved ? '<span class="badge badge-active">✓ Yes</span>' : '<span class="badge badge-inactive">No</span>' !!}</td>
          <td>{!! $c->is_active ? '<span class="badge badge-active">Active</span>' : '<span class="badge badge-inactive">Hidden</span>' !!}</td>
          <td>
            <div class="action-row">
              <a href="{{ route('admin.countries.edit', $c) }}" class="btn btn-sm btn-secondary">✏️ Edit</a>
              <form method="POST" action="{{ route('admin.countries.destroy', $c) }}" onsubmit="return confirm('Delete {{ $c->name }}?')">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">🗑</button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr><td colspan="8"><div class="empty-state"><div class="empty-icon">🌍</div><p>No countries added yet.</p></div></td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection

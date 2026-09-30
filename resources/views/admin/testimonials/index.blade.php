@extends('admin.layout')
@section('admin-title', 'Testimonials')

@section('admin-content')
<div class="page-header">
  <div>
    <h1>⭐ Testimonials</h1>
    <p>Manage student success stories shown in the website carousel.</p>
  </div>
  <div class="page-header-actions">
    <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary">+ Add Testimonial</a>
  </div>
</div>

<div class="card">
  <div class="table-wrap">
    <table>
      <thead>
        <tr><th>Order</th><th>Student</th><th>University</th><th>Stars</th><th>Status</th><th>Actions</th></tr>
      </thead>
      <tbody>
        @forelse($testimonials as $t)
        <tr>
          <td style="color:var(--clr-muted);">{{ $t->sort_order }}</td>
          <td>
            <div style="display:flex;align-items:center;gap:10px;">
              <div style="width:36px;height:36px;border-radius:50%;background:linear-gradient(135deg,#1A4DC5,#0F4C81);display:flex;align-items:center;justify-content:center;font-size:0.75rem;font-weight:700;color:#fff;flex-shrink:0;">
                {{ $t->avatar_initials ?? substr($t->name,0,2) }}
              </div>
              <div>
                <div style="font-weight:700;">{{ $t->name }}</div>
                <div style="font-size:0.75rem;color:var(--clr-muted);">{{ $t->year_batch }} {{ $t->flag_emoji }}</div>
              </div>
            </div>
          </td>
          <td>{{ Str::limit($t->university, 40) }}</td>
          <td>{{ str_repeat('★', $t->stars) }}</td>
          <td>{!! $t->is_active ? '<span class="badge badge-active">Active</span>' : '<span class="badge badge-inactive">Hidden</span>' !!}</td>
          <td>
            <div class="action-row">
              <a href="{{ route('admin.testimonials.edit', $t) }}" class="btn btn-sm btn-secondary">✏️ Edit</a>
              <form method="POST" action="{{ route('admin.testimonials.destroy', $t) }}" onsubmit="return confirm('Delete this testimonial?')">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">🗑</button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr><td colspan="6"><div class="empty-state"><div class="empty-icon">⭐</div><p>No testimonials yet.</p></div></td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection

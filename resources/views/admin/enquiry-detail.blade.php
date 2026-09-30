@extends('admin.layout')
@section('admin-title', 'Enquiry #' . $enquiry->id)

@section('admin-content')
<div style="display:grid;grid-template-columns:1fr 340px;gap:20px;align-items:start;">

  <!-- Main Detail Card -->
  <div class="table-card" style="padding:0;">
    <div class="table-header">
      <h3>📋 Enquiry #{{ $enquiry->id }} — {{ $enquiry->full_name }}</h3>
      <a href="{{ route('admin.enquiries') }}">← Back to List</a>
    </div>
    <div style="padding:24px;display:grid;grid-template-columns:1fr 1fr;gap:20px;">
      <div>
        <p style="font-size:0.75rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.06em;margin-bottom:4px;">Full Name</p>
        <p style="font-weight:600;color:#0d1728;font-size:1rem;">{{ $enquiry->full_name }}</p>
      </div>
      <div>
        <p style="font-size:0.75rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.06em;margin-bottom:4px;">Phone / WhatsApp</p>
        <a href="tel:{{ $enquiry->phone }}" style="font-weight:600;color:#1a56e8;font-size:1rem;">{{ $enquiry->phone }}</a>
      </div>
      <div>
        <p style="font-size:0.75rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.06em;margin-bottom:4px;">Email</p>
        <a href="mailto:{{ $enquiry->email }}" style="font-weight:600;color:#1a56e8;">{{ $enquiry->email }}</a>
      </div>
      <div>
        <p style="font-size:0.75rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.06em;margin-bottom:4px;">Preferred Country</p>
        <p style="font-weight:600;color:#0d1728;">{{ $enquiry->country_label }}</p>
      </div>
      <div>
        <p style="font-size:0.75rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.06em;margin-bottom:4px;">Qualification</p>
        <p style="font-weight:600;color:#0d1728;">{{ $enquiry->qualification ?? '—' }}</p>
      </div>
      <div>
        <p style="font-size:0.75rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.06em;margin-bottom:4px;">Submitted</p>
        <p style="font-weight:600;color:#0d1728;">{{ $enquiry->created_at->format('d M Y, h:i A') }}</p>
      </div>
      @if($enquiry->message)
      <div style="grid-column:1/-1;">
        <p style="font-size:0.75rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.06em;margin-bottom:8px;">Message</p>
        <div style="background:#f8faff;border:1px solid #e2e8f0;border-radius:10px;padding:16px;font-size:0.9rem;color:#4a5568;line-height:1.65;">{{ $enquiry->message }}</div>
      </div>
      @endif
    </div>
  </div>

  <!-- Status Update Sidebar -->
  <div>
    <div class="table-card" style="padding:24px;">
      <h3 style="font-size:1rem;font-weight:700;margin-bottom:16px;">Update Status</h3>
      <p style="font-size:0.85rem;color:#64748b;margin-bottom:12px;">Current: {!! $enquiry->status_badge !!}</p>
      <form method="POST" action="{{ route('admin.enquiries.status', $enquiry->id) }}">
        @csrf @method('PATCH')
        <select name="status" style="width:100%;padding:10px 14px;border:1.5px solid #e2e8f0;border-radius:10px;font-family:inherit;font-size:0.88rem;background:#f8faff;color:#0d1728;margin-bottom:12px;">
          <option value="new"       {{ $enquiry->status=='new'?'selected':'' }}>🔵 New</option>
          <option value="read"      {{ $enquiry->status=='read'?'selected':'' }}>⚪ Read</option>
          <option value="contacted" {{ $enquiry->status=='contacted'?'selected':'' }}>🟡 Contacted</option>
          <option value="enrolled"  {{ $enquiry->status=='enrolled'?'selected':'' }}>🟢 Enrolled</option>
          <option value="rejected"  {{ $enquiry->status=='rejected'?'selected':'' }}>🔴 Rejected</option>
        </select>
        <button type="submit" style="width:100%;padding:10px;background:linear-gradient(135deg,#1a56e8,#0ea5e9);color:#fff;border:none;border-radius:10px;font-size:0.88rem;font-weight:700;cursor:pointer;">Update Status</button>
      </form>
    </div>

    <div class="table-card" style="padding:24px;margin-top:16px;">
      <h3 style="font-size:1rem;font-weight:700;margin-bottom:16px;">Quick Actions</h3>
      <a href="tel:{{ $enquiry->phone }}" style="display:block;padding:10px 16px;background:#dbeafe;color:#1d4ed8;border-radius:10px;font-size:0.85rem;font-weight:600;text-decoration:none;text-align:center;margin-bottom:8px;">📞 Call Student</a>
      <a href="mailto:{{ $enquiry->email }}" style="display:block;padding:10px 16px;background:#dcfce7;color:#166534;border-radius:10px;font-size:0.85rem;font-weight:600;text-decoration:none;text-align:center;margin-bottom:8px;">📧 Send Email</a>
      <form method="POST" action="{{ route('admin.enquiries.destroy', $enquiry->id) }}" onsubmit="return confirm('Permanently delete this enquiry?')">
        @csrf @method('DELETE')
        <button type="submit" style="width:100%;padding:10px 16px;background:#fee2e2;color:#dc2626;border:none;border-radius:10px;font-size:0.85rem;font-weight:600;cursor:pointer;">🗑 Delete Enquiry</button>
      </form>
    </div>
  </div>
</div>
@endsection

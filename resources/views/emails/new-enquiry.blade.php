<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8"/>
  <title>New MBBS Enquiry – EuroMedStudy</title>
</head>
<body style="font-family:Inter,Arial,sans-serif;background:#f4f7fd;padding:32px;">
  <div style="max-width:560px;margin:0 auto;background:#fff;border-radius:16px;overflow:hidden;box-shadow:0 8px 32px rgba(0,0,0,0.12);">
    <div style="background:linear-gradient(135deg,#1340c0,#1a56e8);padding:28px 32px;color:#fff;">
      <h1 style="font-size:1.3rem;margin:0;">📩 New MBBS Enquiry</h1>
      <p style="margin:6px 0 0;opacity:0.85;font-size:0.88rem;">EuroMedStudy Admin Notification</p>
    </div>
    <div style="padding:32px;">
      <table style="width:100%;border-collapse:collapse;font-size:0.9rem;">
        <tr><td style="padding:10px 0;border-bottom:1px solid #f1f5f9;color:#64748b;width:40%;font-weight:600;">Name</td><td style="padding:10px 0;border-bottom:1px solid #f1f5f9;color:#0d1728;font-weight:700;">{{ $enquiry->full_name }}</td></tr>
        <tr><td style="padding:10px 0;border-bottom:1px solid #f1f5f9;color:#64748b;font-weight:600;">Phone</td><td style="padding:10px 0;border-bottom:1px solid #f1f5f9;color:#1a56e8;">{{ $enquiry->phone }}</td></tr>
        <tr><td style="padding:10px 0;border-bottom:1px solid #f1f5f9;color:#64748b;font-weight:600;">Email</td><td style="padding:10px 0;border-bottom:1px solid #f1f5f9;color:#1a56e8;">{{ $enquiry->email }}</td></tr>
        <tr><td style="padding:10px 0;border-bottom:1px solid #f1f5f9;color:#64748b;font-weight:600;">Country</td><td style="padding:10px 0;border-bottom:1px solid #f1f5f9;color:#0d1728;">{{ $enquiry->country_label }}</td></tr>
        <tr><td style="padding:10px 0;border-bottom:1px solid #f1f5f9;color:#64748b;font-weight:600;">Qualification</td><td style="padding:10px 0;border-bottom:1px solid #f1f5f9;color:#0d1728;">{{ $enquiry->qualification ?? '—' }}</td></tr>
        @if($enquiry->message)
        <tr><td style="padding:10px 0;color:#64748b;font-weight:600;vertical-align:top;">Message</td><td style="padding:10px 0;color:#0d1728;">{{ $enquiry->message }}</td></tr>
        @endif
      </table>
      <a href="{{ route('admin.enquiries.show', $enquiry->id) }}" style="display:block;margin-top:24px;padding:13px;background:linear-gradient(135deg,#1a56e8,#0ea5e9);color:#fff;text-align:center;border-radius:12px;text-decoration:none;font-weight:700;font-size:0.92rem;">View in Admin Panel →</a>
    </div>
    <div style="padding:16px 32px;background:#f8faff;border-top:1px solid #e2e8f0;text-align:center;font-size:0.78rem;color:#94a3b8;">
      EuroMedStudy Admin Notification | {{ now()->format('d M Y, h:i A') }}
    </div>
  </div>
</body>
</html>

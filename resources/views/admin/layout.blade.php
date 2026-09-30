<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>@yield('admin-title', 'Admin') — EuroMedStudy CMS</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet"/>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <style>
    *{margin:0;padding:0;box-sizing:border-box;}
    :root{
      --sidebar-w:260px;
      --clr-navy:#0F2B5B;
      --clr-blue:#1A4DC5;
      --clr-blue-light:#2563EB;
      --clr-accent:#0F4C81;
      --clr-bg:#F0F4FA;
      --clr-card:#FFFFFF;
      --clr-border:#E2E8F0;
      --clr-text:#0D1728;
      --clr-muted:#64748B;
      --clr-success:#059669;
      --clr-danger:#DC2626;
      --clr-warn:#D97706;
    }
    body{font-family:'Inter',sans-serif;background:var(--clr-bg);color:var(--clr-text);display:flex;min-height:100vh;}

    /* ── SIDEBAR ── */
    .sidebar{
      position:fixed;top:0;left:0;bottom:0;width:var(--sidebar-w);
      background:var(--clr-navy);
      display:flex;flex-direction:column;z-index:200;
      box-shadow:4px 0 20px rgba(0,0,0,0.15);
    }
    .sidebar-logo{
      padding:24px 22px 20px;
      border-bottom:1px solid rgba(255,255,255,0.08);
      display:flex;align-items:center;gap:12px;
    }
    .sidebar-logo-icon{
      width:38px;height:38px;background:linear-gradient(135deg,#1A4DC5,#0F4C81);
      border-radius:10px;display:flex;align-items:center;justify-content:center;
      font-size:1.3rem;flex-shrink:0;
    }
    .sidebar-logo-text{font-size:1rem;font-weight:800;color:#fff;line-height:1.2;}
    .sidebar-logo-sub{font-size:0.65rem;color:rgba(255,255,255,0.45);font-weight:500;letter-spacing:0.08em;text-transform:uppercase;}

    .sidebar-section-label{
      padding:18px 22px 6px;
      font-size:0.62rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;
      color:rgba(255,255,255,0.3);
    }
    .nav-item{
      display:flex;align-items:center;gap:11px;
      padding:10px 22px;margin:1px 10px;border-radius:8px;
      font-size:0.855rem;font-weight:500;color:rgba(255,255,255,0.7);
      cursor:pointer;transition:all 0.2s;text-decoration:none;
    }
    .nav-item:hover{background:rgba(255,255,255,0.08);color:#fff;}
    .nav-item.active{background:rgba(26,77,197,0.5);color:#fff;font-weight:600;}
    .nav-item.active .ni-icon{color:#60A5FA;}
    .ni-icon{font-size:1rem;width:18px;text-align:center;flex-shrink:0;}
    .nav-item .ni-badge{
      margin-left:auto;background:#EF4444;color:#fff;
      font-size:0.65rem;font-weight:700;padding:1px 7px;border-radius:100px;
    }

    .sidebar-footer{padding:16px 12px;border-top:1px solid rgba(255,255,255,0.08);}
    .sidebar-footer form{display:block;}
    .logout-btn{
      width:100%;display:flex;align-items:center;gap:10px;
      padding:10px 12px;border-radius:8px;background:rgba(239,68,68,0.1);
      border:1px solid rgba(239,68,68,0.2);color:rgba(255,255,255,0.75);
      font-size:0.84rem;font-weight:600;cursor:pointer;transition:all 0.2s;
    }
    .logout-btn:hover{background:rgba(239,68,68,0.25);color:#fff;}

    /* ── MAIN CONTENT ── */
    .main-wrap{margin-left:var(--sidebar-w);flex:1;display:flex;flex-direction:column;min-height:100vh;}

    .topbar{
      background:#fff;border-bottom:1px solid var(--clr-border);
      padding:14px 28px;display:flex;align-items:center;justify-content:space-between;
      position:sticky;top:0;z-index:100;
    }
    .topbar-left{display:flex;align-items:center;gap:12px;}
    .topbar-title{font-size:1.05rem;font-weight:700;color:var(--clr-text);}
    .topbar-breadcrumb{font-size:0.78rem;color:var(--clr-muted);}
    .topbar-breadcrumb a{color:var(--clr-blue-light);text-decoration:none;}
    .topbar-right{display:flex;align-items:center;gap:14px;}
    .topbar-date{font-size:0.8rem;color:var(--clr-muted);}
    .topbar-user{
      display:flex;align-items:center;gap:8px;
      background:var(--clr-bg);border:1px solid var(--clr-border);
      padding:6px 12px 6px 8px;border-radius:100px;
    }
    .user-avatar{
      width:28px;height:28px;border-radius:50%;
      background:linear-gradient(135deg,#1A4DC5,#0F4C81);
      display:flex;align-items:center;justify-content:center;
      font-size:0.7rem;font-weight:700;color:#fff;
    }
    .topbar-user span{font-size:0.8rem;font-weight:600;color:var(--clr-text);}

    .page-body{padding:28px;flex:1;}

    /* ── ALERTS ── */
    .alert{padding:12px 18px;border-radius:10px;margin-bottom:20px;font-size:0.87rem;font-weight:500;display:flex;align-items:center;gap:10px;}
    .alert-success{background:#D1FAE5;border:1px solid #6EE7B7;color:var(--clr-success);}
    .alert-error{background:#FEE2E2;border:1px solid #FCA5A5;color:var(--clr-danger);}

    /* ── PAGE HEADER ── */
    .page-header{display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:24px;gap:12px;flex-wrap:wrap;}
    .page-header h1{font-size:1.4rem;font-weight:800;color:var(--clr-text);}
    .page-header p{font-size:0.85rem;color:var(--clr-muted);margin-top:3px;}
    .page-header-actions{display:flex;gap:10px;align-items:center;flex-shrink:0;}

    /* ── BUTTONS ── */
    .btn{display:inline-flex;align-items:center;gap:7px;padding:9px 18px;border-radius:9px;font-size:0.85rem;font-weight:600;cursor:pointer;border:none;text-decoration:none;transition:all 0.2s;}
    .btn-primary{background:var(--clr-blue);color:#fff;}
    .btn-primary:hover{background:#1558D6;transform:translateY(-1px);box-shadow:0 4px 12px rgba(26,77,197,0.3);}
    .btn-secondary{background:#fff;color:var(--clr-text);border:1px solid var(--clr-border);}
    .btn-secondary:hover{background:var(--clr-bg);border-color:#C4CDD6;}
    .btn-danger{background:#FEE2E2;color:var(--clr-danger);border:1px solid #FCA5A5;}
    .btn-danger:hover{background:var(--clr-danger);color:#fff;}
    .btn-success{background:#D1FAE5;color:var(--clr-success);}
    .btn-success:hover{background:var(--clr-success);color:#fff;}
    .btn-sm{padding:5px 12px;font-size:0.78rem;}
    .btn-xs{padding:3px 9px;font-size:0.72rem;}

    /* ── CARDS ── */
    .card{background:var(--clr-card);border:1px solid var(--clr-border);border-radius:14px;box-shadow:0 1px 8px rgba(0,0,0,0.05);}
    .card-header{padding:18px 24px;border-bottom:1px solid var(--clr-border);display:flex;align-items:center;justify-content:space-between;}
    .card-header h3{font-size:0.95rem;font-weight:700;}
    .card-body{padding:24px;}

    /* ── STATS GRID ── */
    .stats-grid{display:grid;grid-template-columns:repeat(5,1fr);gap:16px;margin-bottom:24px;}
    .stat-card{background:#fff;border:1px solid var(--clr-border);border-radius:14px;padding:20px;transition:transform 0.2s,box-shadow 0.2s;}
    .stat-card:hover{transform:translateY(-2px);box-shadow:0 8px 24px rgba(0,0,0,0.08);}
    .stat-card-top{display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;}
    .stat-icon{width:40px;height:40px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:1.2rem;}
    .stat-num{font-size:2rem;font-weight:800;line-height:1;}
    .stat-label{font-size:0.75rem;color:var(--clr-muted);margin-top:4px;font-weight:500;}
    .stat-card.blue .stat-icon{background:#DBEAFE;} .stat-card.blue .stat-num{color:var(--clr-blue);}
    .stat-card.green .stat-icon{background:#D1FAE5;} .stat-card.green .stat-num{color:var(--clr-success);}
    .stat-card.amber .stat-icon{background:#FEF3C7;} .stat-card.amber .stat-num{color:var(--clr-warn);}
    .stat-card.red .stat-icon{background:#FEE2E2;} .stat-card.red .stat-num{color:var(--clr-danger);}
    .stat-card.purple .stat-icon{background:#EDE9FE;} .stat-card.purple .stat-num{color:#7C3AED;}

    /* ── TABLE ── */
    .table-wrap{overflow-x:auto;}
    table{width:100%;border-collapse:collapse;font-size:0.85rem;}
    thead{background:#F8FAFF;}
    thead th{padding:11px 18px;text-align:left;font-size:0.72rem;font-weight:700;text-transform:uppercase;letter-spacing:0.07em;color:var(--clr-muted);white-space:nowrap;}
    tbody tr{border-top:1px solid var(--clr-border);transition:background 0.15s;}
    tbody tr:hover{background:#F8FAFF;}
    tbody td{padding:12px 18px;color:#374151;vertical-align:middle;}
    tbody td:first-child{font-weight:600;color:var(--clr-text);}

    /* ── BADGES ── */
    .badge{display:inline-flex;align-items:center;padding:3px 9px;border-radius:100px;font-size:0.71rem;font-weight:700;}
    .badge-new{background:#DBEAFE;color:#1D4ED8;}
    .badge-read{background:#F1F5F9;color:#475569;}
    .badge-contacted{background:#FEF9C3;color:#854D0E;}
    .badge-enrolled{background:#D1FAE5;color:#166534;}
    .badge-rejected{background:#FEE2E2;color:#991B1B;}
    .badge-active{background:#D1FAE5;color:#166534;}
    .badge-inactive{background:#F1F5F9;color:#64748B;}
    .badge-published{background:#D1FAE5;color:#166534;}
    .badge-draft{background:#FEF3C7;color:#854D0E;}

    /* ── FORM ELEMENTS ── */
    .form-grid{display:grid;gap:20px;}
    .form-grid-2{grid-template-columns:1fr 1fr;}
    .form-grid-3{grid-template-columns:1fr 1fr 1fr;}
    .form-group{display:flex;flex-direction:column;gap:6px;}
    .form-group label{font-size:0.8rem;font-weight:700;color:var(--clr-text);letter-spacing:0.02em;}
    .form-group .help-text{font-size:0.75rem;color:var(--clr-muted);}
    .form-control{
      width:100%;padding:10px 14px;
      border:1.5px solid var(--clr-border);border-radius:9px;
      font-size:0.87rem;font-family:'Inter',sans-serif;
      color:var(--clr-text);background:#fff;
      transition:border-color 0.2s,box-shadow 0.2s;
    }
    .form-control:focus{outline:none;border-color:var(--clr-blue-light);box-shadow:0 0 0 3px rgba(37,99,235,0.12);}
    textarea.form-control{resize:vertical;min-height:100px;}
    select.form-control{cursor:pointer;}
    .form-check{display:flex;align-items:center;gap:10px;cursor:pointer;}
    .form-check input[type=checkbox]{width:17px;height:17px;accent-color:var(--clr-blue);cursor:pointer;}
    .form-check label{font-size:0.85rem;font-weight:500;cursor:pointer;}

    /* ── SECTION CARD ── */
    .settings-group{margin-bottom:28px;}
    .settings-group-header{
      display:flex;align-items:center;gap:10px;margin-bottom:16px;
      padding-bottom:10px;border-bottom:2px solid var(--clr-border);
    }
    .settings-group-header h3{font-size:0.95rem;font-weight:800;color:var(--clr-text);}
    .settings-group-icon{font-size:1.1rem;}

    /* ── ACTION BTNS ── */
    .action-row{display:flex;gap:6px;align-items:center;}

    /* ── FILTERS ── */
    .filter-bar{display:flex;gap:10px;margin-bottom:20px;flex-wrap:wrap;align-items:center;}
    .filter-bar .form-control{max-width:180px;padding:8px 12px;}

    /* ── EMPTY STATE ── */
    .empty-state{text-align:center;padding:48px 20px;color:var(--clr-muted);}
    .empty-state .empty-icon{font-size:3rem;margin-bottom:12px;}
    .empty-state p{font-size:0.9rem;}

    /* ── PAGINATION ── */
    .pagi{display:flex;gap:4px;justify-content:flex-end;padding:14px 18px;border-top:1px solid var(--clr-border);}
    .pagi a,.pagi span{padding:6px 11px;border-radius:7px;font-size:0.8rem;font-weight:600;border:1px solid var(--clr-border);background:#fff;color:var(--clr-muted);text-decoration:none;}
    .pagi .active,.pagi span.current{background:var(--clr-blue);color:#fff;border-color:var(--clr-blue);}

    /* ── RESPONSIVE ── */
    @media(max-width:1200px){.stats-grid{grid-template-columns:repeat(3,1fr);}}
    @media(max-width:900px){.form-grid-2,.form-grid-3{grid-template-columns:1fr;}}
    @media(max-width:768px){
      .sidebar{transform:translateX(-100%);transition:transform 0.3s;}
      .sidebar.open{transform:translateX(0);}
      .main-wrap{margin-left:0;}
      .stats-grid{grid-template-columns:repeat(2,1fr);}
      .page-body{padding:16px;}
    }
  </style>
</head>
<body>

<!-- ── SIDEBAR ── -->
<aside class="sidebar" id="sidebar">
  <div class="sidebar-logo">
    <div class="sidebar-logo-icon">⚕</div>
    <div>
      <div class="sidebar-logo-text">EuroMedStudy</div>
      <div class="sidebar-logo-sub">Content Management</div>
    </div>
  </div>

  <nav style="flex:1;overflow-y:auto;padding:12px 0;">
    <div class="sidebar-section-label">Overview</div>
    <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
      <span class="ni-icon">📊</span> Dashboard
      @php $newCount = \App\Models\Enquiry::where('status','new')->count(); @endphp
      @if($newCount > 0)<span class="ni-badge">{{ $newCount }}</span>@endif
    </a>

    <div class="sidebar-section-label">Website Content</div>
    <a href="{{ route('admin.settings') }}" class="nav-item {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
      <span class="ni-icon">⚙️</span> Site Settings
    </a>
    <a href="{{ route('admin.countries') }}" class="nav-item {{ request()->routeIs('admin.countries*') ? 'active' : '' }}">
      <span class="ni-icon">🌍</span> Countries
    </a>
    <a href="{{ route('admin.universities') }}" class="nav-item {{ request()->routeIs('admin.universities*') ? 'active' : '' }}">
      <span class="ni-icon">🏛️</span> Universities
    </a>
    <a href="{{ route('admin.testimonials') }}" class="nav-item {{ request()->routeIs('admin.testimonials*') ? 'active' : '' }}">
      <span class="ni-icon">⭐</span> Testimonials
    </a>
    <a href="{{ route('admin.blog') }}" class="nav-item {{ request()->routeIs('admin.blog*') ? 'active' : '' }}">
      <span class="ni-icon">📝</span> Blog Posts
    </a>

    <div class="sidebar-section-label">Leads</div>
    <a href="{{ route('admin.enquiries') }}" class="nav-item {{ request()->routeIs('admin.enquiries*') ? 'active' : '' }}">
      <span class="ni-icon">📩</span> All Enquiries
      @if($newCount > 0)<span class="ni-badge">{{ $newCount }}</span>@endif
    </a>
    <a href="{{ route('admin.enquiries.export') }}" class="nav-item">
      <span class="ni-icon">📥</span> Export CSV
    </a>

    <div class="sidebar-section-label">Website</div>
    <a href="{{ route('home') }}" class="nav-item" target="_blank">
      <span class="ni-icon">🌐</span> View Website
    </a>
  </nav>

  <div class="sidebar-footer">
    <form method="POST" action="{{ route('admin.logout') }}">
      @csrf
      <button type="submit" class="logout-btn">
        <span>🚪</span> Logout
      </button>
    </form>
  </div>
</aside>

<!-- ── MAIN WRAP ── -->
<div class="main-wrap">
  <header class="topbar">
    <div class="topbar-left">
      <h2 class="topbar-title">@yield('admin-title', 'Dashboard')</h2>
    </div>
    <div class="topbar-right">
      <span class="topbar-date">{{ now()->format('D, d M Y') }}</span>
      <div class="topbar-user">
        <div class="user-avatar">AD</div>
        <span>Administrator</span>
      </div>
    </div>
  </header>

  <div class="page-body">
    @if(session('success'))
    <div class="alert alert-success">✅ {{ session('success') }}</div>
    @endif
    @if(session('error'))
    <div class="alert alert-error">❌ {{ session('error') }}</div>
    @endif
    @if($errors->any())
    <div class="alert alert-error">
      ❌ Please fix the following errors:
      <ul style="margin-top:6px;padding-left:16px;">
        @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
      </ul>
    </div>
    @endif

    @yield('admin-content')
  </div>
</div>

</body>
</html>

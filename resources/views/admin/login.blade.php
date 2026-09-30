<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Login – EuroMedStudy</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
  <style>
    *{margin:0;padding:0;box-sizing:border-box;}
    body{font-family:'Inter',sans-serif;background:linear-gradient(135deg,#1340c0,#1a56e8,#0ea5e9);min-height:100vh;display:flex;align-items:center;justify-content:center;padding:24px;}
    .login-box{background:#fff;border-radius:24px;padding:48px 40px;width:100%;max-width:420px;box-shadow:0 20px 60px rgba(0,0,0,0.25);}
    .login-logo{text-align:center;margin-bottom:32px;}
    .login-logo span.icon{font-size:2.5rem;}
    .login-logo h1{font-size:1.5rem;font-weight:800;color:#0d1728;margin-top:8px;}
    .login-logo p{font-size:0.85rem;color:#64748b;margin-top:4px;}
    .form-group{margin-bottom:18px;}
    .form-group label{display:block;font-size:0.82rem;font-weight:600;color:#4a5568;margin-bottom:6px;}
    .form-group input{width:100%;padding:12px 16px;border:1.5px solid #e2e8f0;border-radius:10px;font-size:0.92rem;color:#0d1728;background:#f8faff;transition:border 0.2s,box-shadow 0.2s;}
    .form-group input:focus{outline:none;border-color:#1a56e8;box-shadow:0 0 0 3px rgba(26,86,232,0.12);background:#fff;}
    .btn-login{width:100%;padding:13px;background:linear-gradient(135deg,#1a56e8,#0ea5e9);color:#fff;border:none;border-radius:12px;font-size:0.95rem;font-weight:700;cursor:pointer;margin-top:4px;transition:all 0.3s;}
    .btn-login:hover{transform:translateY(-2px);box-shadow:0 8px 24px rgba(26,86,232,0.4);}
    .error-msg{background:#fef2f2;border:1px solid #fecaca;color:#dc2626;padding:12px 16px;border-radius:10px;font-size:0.85rem;margin-bottom:20px;}
    .flash-err{background:#fef2f2;border:1px solid #fecaca;color:#dc2626;padding:12px 16px;border-radius:10px;font-size:0.85rem;margin-bottom:20px;}
    .back-link{display:block;text-align:center;margin-top:20px;font-size:0.85rem;color:#64748b;}
    .back-link a{color:#1a56e8;font-weight:600;}
  </style>
</head>
<body>
  <div class="login-box">
    <div class="login-logo">
      <span class="icon">⚕</span>
      <h1>Admin Panel</h1>
      <p>EuroMedStudy – Secure Login</p>
    </div>

    @if(session('error'))
    <div class="flash-err">{{ session('error') }}</div>
    @endif

    @if($errors->has('credentials'))
    <div class="error-msg">{{ $errors->first('credentials') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.login.post') }}">
      @csrf
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="Enter username" value="{{ old('username') }}" required autofocus />
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Enter password" required />
      </div>
      <button type="submit" class="btn-login">Login to Admin Panel →</button>
    </form>

    <p class="back-link"><a href="{{ route('home') }}">← Back to Website</a></p>
  </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Sahaara Portal</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Amiri:wght@700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, #0e241c 0%, #1a4d3e 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-card {
            background: #ffffff;
            border-radius: 18px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.3);
            width: 100%;
            max-width: 440px;
            overflow: hidden;
        }

        .login-header {
            background-color: #14352a;
            color: #ffffff;
            padding: 30px 25px;
            text-align: center;
        }

        .btn-login {
            background-color: #1a4d3e;
            color: white;
            font-weight: 700;
            padding: 12px;
            border-radius: 10px;
            border: none;
            transition: all 0.2s;
        }

        .btn-login:hover {
            background-color: #13392e;
            color: white;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="login-header">
            <div class="bg-success bg-opacity-25 text-warning rounded-circle d-inline-flex p-3 mb-2 fs-2">
                <i class="bi bi-shield-lock-fill"></i>
            </div>
            <h4 class="fw-bold mb-1">SAHAARA ADMIN</h4>
            <p class="small text-white-50 mb-0">Funeral & Janazah Management Operations</p>
        </div>

        <div class="p-4 p-sm-5">
            @if(session('success'))
                <div class="alert alert-success small py-2 mb-3">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger small py-2 mb-3">
                    {{ $errors->first() }}
                </div>
            @endif

            <!-- Quick Demo Credentials Box -->
            <div class="p-3 bg-light rounded-3 border mb-4 small">
                <div class="fw-bold text-success mb-1 d-flex align-items-center justify-content-between">
                    <span><i class="bi bi-key-fill me-1"></i> Admin Credentials</span>
                    <button type="button" class="btn btn-sm btn-outline-success py-0 px-2" style="font-size: 0.75rem;" onclick="document.getElementById('email').value='admin@sahaara.com'; document.getElementById('password').value='admin123';">
                        Auto-Fill
                    </button>
                </div>
                <div><strong>Email:</strong> <code>admin@sahaara.com</code></div>
                <div><strong>Password:</strong> <code>admin123</code></div>
            </div>

            <form action="{{ route('admin.login.submit') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-bold small text-muted">Email Address</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="bi bi-envelope"></i></span>
                        <input type="email" name="email" id="email" value="{{ old('email', 'admin@sahaara.com') }}" class="form-control" placeholder="admin@sahaara.com" required autofocus>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold small text-muted">Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="bi bi-lock"></i></span>
                        <input type="password" name="password" id="password" value="admin123" class="form-control" placeholder="••••••••" required>
                    </div>
                </div>

                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" checked>
                    <label class="form-check-label small text-muted" for="remember">
                        Remember Me
                    </label>
                </div>

                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-login fs-6">
                        <i class="bi bi-box-arrow-in-right me-1"></i> Sign In to Dashboard
                    </button>
                </div>

                <div class="text-center">
                    <a href="{{ route('home') }}" class="small text-decoration-none text-muted">
                        <i class="bi bi-arrow-left me-1"></i> Return to Public Website
                    </a>
                </div>
            </form>
        </div>
    </div>

</body>
</html>

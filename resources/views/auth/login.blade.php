<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Litera</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    body {
      font-family: 'Georgia', serif;
      background-color: #f5f3f0;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }
    .login-card {
      background: white;
      border-radius: 10px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
      padding: 2.5rem;
      width: 100%;
      max-width: 480px; /* diperlebar */
      border-top: 5px solid #8B4513;
    }
    .brand {
      text-align: center;
      color: #8B4513;
      font-size: 2.2rem;
      font-weight: bold;
      margin-bottom: 1.8rem;
    }
    .form-control {
      border: 1px solid #d4c4b8;
      padding: 0.8rem;
      font-size: 1rem;
    }
    .form-control:focus {
      border-color: #8B4513;
      box-shadow: 0 0 0 0.2rem rgba(139,69,19,0.15);
    }
    .btn-login {
      background-color: #8B4513;
      border-color: #8B4513;
      color: white;
      padding: 0.8rem;
      font-weight: 600;
      transition: 0.3s;
    }
    .btn-login:hover {
      background-color: #6d3b0f;
      border-color: #6d3b0f;
    }
    .login-footer {
      text-align: center;
      margin-top: 1.5rem;
      padding-top: 1rem;
      border-top: 1px solid #e9ecef;
    }
    .login-footer a {
      color: #8B4513;
      text-decoration: none;
      font-weight: 500;
    }
    .login-footer a:hover {
      text-decoration: underline;
    }
    .alert {
      border-radius: 6px;
      border: none;
      font-size: 0.95rem;
    }
  </style>
</head>

<body>
  <div class="login-card">
    <div class="brand"><i class="fas fa-book me-2"></i>Litera</div>

    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-check-circle me-2"></i>{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
    @endif

    @if(session('error'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
    @endif

    @if($errors->any())
      <div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="fas fa-exclamation-triangle me-2"></i><ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
    @endif

    <form method="POST" action="{{ route('login') }}">
      @csrf
      <div class="mb-3"><label for="email" class="form-label">Email</label><input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Email anda" required autofocus>@error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
      <div class="mb-3"><label for="password" class="form-label">Password</label><input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password anda" required>@error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
      <div class="mb-3 form-check"><input type="checkbox" class="form-check-input" id="remember" name="remember"><label class="form-check-label" for="remember">Ingat saya</label></div>
      <button type="submit" class="btn btn-login w-100 mb-3"><i class="fas fa-sign-in-alt me-2"></i>Login</button>
      <div class="login-footer"><p class="mb-0">Belum punya akun? <a href="{{ route('register.form') }}">Daftar di sini</a></p></div>
    </form>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

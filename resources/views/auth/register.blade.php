<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Litera</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Georgia', serif;
            background-color: #f5f3f0;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        .register-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
            padding: 2rem 2.5rem;
            width: 100%;
            max-width: 520px;
            border-top: 4px solid #8B4513;
        }

        .brand {
            text-align: center;
            color: #8B4513;
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 1.5rem;
        }

        h4 {
            text-align: center;
            color: #8B4513;
            margin-bottom: 1.5rem;
        }

        .form-label {
            font-weight: 600;
            color: #5a4634;
        }

        .form-control {
            border: 1px solid #d4c4b8;
            padding: 0.7rem;
        }

        .form-control:focus {
            border-color: #8B4513;
            box-shadow: 0 0 0 0.2rem rgba(139, 69, 19, 0.15);
        }

        .btn-register {
            background-color: #8B4513;
            color: white;
            font-weight: 600;
            border: none;
            padding: 0.75rem;
            transition: 0.3s;
        }

        .btn-register:hover {
            background-color: #6f3b10;
        }

        .register-footer {
            text-align: center;
            margin-top: 1.2rem;
            font-size: 0.95rem;
        }

        .register-footer a {
            color: #8B4513;
            text-decoration: none;
            font-weight: 600;
        }

        .register-footer a:hover {
            text-decoration: underline;
        }

        .alert {
            border-radius: 6px;
            border: none;
        }

        .password-requirements {
            font-size: 0.8rem;
            color: #6c757d;
            margin-top: 0.2rem;
        }
    </style>
</head>

<body>
    <div class="register-card">
        <div class="brand"><i class="fas fa-book me-2"></i>Litera</div>
        <h4>Daftar Akun Baru</h4>

        <!-- Pesan Notifikasi -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <ul class="mb-0 ps-3">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Masukkan nama" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Minimal 8 karakter" required>
                <div class="password-requirements"><small>Password minimal 8 karakter</small></div>
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Ulangi password" required>
            </div>

            <button type="submit" class="btn btn-register w-100"><i class="fas fa-user-plus me-2"></i>Daftar</button>

            <div class="register-footer mt-3">
                <p>Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a></p>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const password = document.getElementById('password');
        const confirm = document.getElementById('password_confirmation');

        confirm.addEventListener('input', function() {
            this.classList.toggle('is-invalid', password.value !== this.value);
        });

        document.querySelector('form').addEventListener('submit', e => {
            if (password.value !== confirm.value) {
                e.preventDefault();
                alert('Password dan konfirmasi password tidak sama!');
            }
        });
    </script>
</body>
</html>

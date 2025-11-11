<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ config('app.name', 'Litera') }}</title>

  <link rel="stylesheet" 
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    header, footer {
      background: #f5f3f0;
      border-color: #8B4513;
    }

    header {
      border-bottom: 2px solid #8B4513;
    }

    footer {
      border-top: 2px solid #8B4513;
    }

    .brand {
      color: #8B4513;
      font-size: 1.8rem;
      font-weight: bold;
    }

    .nav-link {
      font-weight: 500;
      color: #8B4513 !important;
    }

    .nav-link:hover {
      color: #654321 !important;
    }
  </style>
</head>
<body>
  <header>
    <nav class="navbar navbar-expand-lg">
      <div class="container py-2">
        <div class="brand"><i class="fas fa-book me-2"></i>Litera</div>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navMenu">
          <ul class="navbar-nav gap-2">
            @auth
              @if(Auth::user()->role === 'admin')
                <li class="nav-item"><a href="{{ route('admin.dashboard') }}" class="nav-link">Dashboard</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Pending Request</a></li>
                <li class="nav-item"><a href="{{ route('admin.user.index') }}" class="nav-link">Kelola User</a></li>
                <li class="nav-item"><a href="admin.books.index" class="nav-link">Kelola Buku</a></li>
                <li class="nav-item"><a href="{{ route('logout') }}" class="nav-link">Logout</a></li>
              @elseif(Auth::user()->role === 'pengguna')
                <li class="nav-item"><a href="{{ route('user.dashboard') }}" class="nav-link">Dashboard</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Kategori</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Peminjaman</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Profile</a></li>
              @endif
            @endauth
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <main class="py-4">
    @yield('content')
  </main>

  <footer>
      <div class="container text-center py-3">
          <p class="m-0 fw-semibold" style="color: #8B4513;">
              © {{ date('Y') }} Litera — All Rights Reserved.
         </p>
      </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  
</body>
</html>
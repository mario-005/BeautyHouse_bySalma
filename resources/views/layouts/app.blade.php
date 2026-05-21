<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'BeautyHouse by Salma')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root {
            --bh-red: #dc3545;
            --bh-dark-red: #a82330;
            --bh-light-red: #fff5f6;
            --bh-text: #2d3748;
        }
        body { font-family: 'Inter', sans-serif; color: var(--bh-text); background-color: #fcfcfc; display: flex; flex-direction: column; min-height: 100vh; }
        main { flex: 1; }
        .navbar { box-shadow: 0 4px 12px rgba(0,0,0,0.04); border-bottom: 2px solid var(--bh-light-red); }
        .navbar-brand { font-weight: 800; letter-spacing: -0.5px; font-size: 1.3rem; }
        .navbar-brand .brand-beauty { color: var(--bh-red); }
        .navbar-brand .brand-house { color: #1a202c; }
        .btn-bh-red { background-color: var(--bh-red); color: #fff; font-weight: 500; border-radius: 8px; border: none; transition: all 0.2s ease; text-decoration: none; display: inline-block; }
        .btn-bh-red:hover { background-color: var(--bh-dark-red); color: #fff; transform: translateY(-1px); }
        .btn-bh-outline { border: 1.5px solid var(--bh-red); color: var(--bh-red); background: transparent; font-weight: 500; border-radius: 8px; transition: all 0.2s ease; text-decoration: none; display: inline-block; }
        .btn-bh-outline:hover { background-color: var(--bh-red); color: #fff; }
        .card-custom { border-radius: 14px; background: #fff; box-shadow: 0 2px 12px rgba(0,0,0,0.06); transition: box-shadow 0.25s ease, transform 0.25s ease; }
        .card-custom:hover { box-shadow: 0 8px 28px rgba(220,53,69,0.13); transform: translateY(-3px); }
        .badge-category { font-size: 0.7rem; font-weight: 600; letter-spacing: 0.5px; text-transform: uppercase; padding: 4px 10px; border-radius: 20px; }
        .badge-sunscreen { background-color: #fef9c3; color: #854d0e; }
        .badge-facewash { background-color: #dbeafe; color: #1e40af; }
        .badge-scrub { background-color: #ede9fe; color: #4338ca; }
        .badge-serum { background-color: #ffe4e6; color: #be123c; }
        .badge-fashion { background-color: #e0e7ff; color: #3730a3; }
        .star-filled { color: #f59e0b; }
        .star-empty { color: #d1d5db; }
        .alert { border-radius: 10px; border: none; }
        .form-control:focus, .form-select:focus { border-color: var(--bh-red); box-shadow: 0 0 0 0.2rem rgba(220,53,69,0.15); }
        footer { background: #1a202c; color: #94a3b8; }
        .footer-brand { color: var(--bh-red); font-weight: 800; font-size: 1.2rem; }
        .nav-link { font-weight: 500; transition: color 0.15s; }
        .nav-link:hover { color: var(--bh-red) !important; }
        .cart-badge { position: absolute; top: -6px; right: -8px; background: var(--bh-red); color: white; border-radius: 50%; width: 18px; height: 18px; font-size: 0.65rem; display: flex; align-items: center; justify-content: center; font-weight: 700; }
        .price-text { color: var(--bh-red); font-weight: 700; }
        .section-title { font-weight: 800; color: #1a202c; }
        .divider-red { border: none; height: 3px; background: linear-gradient(90deg, var(--bh-red), #f97316); border-radius: 2px; width: 60px; }
        .table thead th { font-weight: 600; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px; color: #6b7280; background: #f9fafb; }
        .status-pending { background: #fef3c7; color: #92400e; }
        .status-diproses { background: #dbeafe; color: #1e40af; }
        .status-selesai { background: #d1fae5; color: #065f46; }
        .status-dibatalkan { background: #fee2e2; color: #991b1b; }
        .status-badge { font-size: 0.75rem; font-weight: 600; padding: 4px 12px; border-radius: 20px; }
        .hero-section { background: linear-gradient(135deg, #fff5f6 0%, #fce7f3 50%, #fff1f2 100%); }
        .filter-pill { border-radius: 25px; font-weight: 500; font-size: 0.875rem; padding: 6px 18px; cursor: pointer; border: 1.5px solid #e5e7eb; background: #fff; color: #374151; transition: all 0.2s; text-decoration: none; }
        .filter-pill:hover, .filter-pill.active { background: var(--bh-red); color: #fff; border-color: var(--bh-red); }
    </style>
    @yield('styles')
</head>
<body>

<nav class="navbar navbar-expand-lg bg-white py-3 sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <span class="brand-beauty">Beauty</span><span class="brand-house">House</span>
            <span class="text-muted fw-normal" style="font-size:0.75rem; display:block; line-height:1;">by Salma</span>
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarMain">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-3">
                <li class="nav-item"><a class="nav-link text-dark" href="{{ route('home') }}">Beranda</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link text-dark dropdown-toggle" href="#" data-bs-toggle="dropdown">Beauty</a>
                    <ul class="dropdown-menu shadow border-0" style="border-radius:12px;">
                        <li><a class="dropdown-item" href="{{ route('home') }}?category=Sunscreen">Sunscreen</a></li>
                        <li><a class="dropdown-item" href="{{ route('home') }}?category=Face+Wash">Face Wash</a></li>
                        <li><a class="dropdown-item" href="{{ route('home') }}?category=Scrub">Scrub</a></li>
                        <li><a class="dropdown-item" href="{{ route('home') }}?category=Serum">Serum</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link text-dark" href="{{ route('home') }}?category=Fashion">Fashion</a></li>

            </ul>
            <div class="d-flex align-items-center gap-2">
                @auth
                    <a href="{{ route('cart.index') }}" class="btn btn-light btn-sm position-relative px-3 py-2 rounded-3">
                        <i class="bi bi-bag"></i>
                        @php $cartCount = \App\Models\Cart::where('user_id', Auth::id())->sum('quantity'); @endphp
                        @if($cartCount > 0)
                            <span class="cart-badge">{{ $cartCount }}</span>
                        @endif
                    </a>
                    <div class="dropdown">
                        <button class="btn btn-light btn-sm dropdown-toggle px-3 py-2 rounded-3" type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle me-1"></i>{{ Auth::user()->name }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0" style="border-radius:12px;">
                            @if(Auth::user()->isAdmin())
                                <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2 me-2 text-danger"></i>Dashboard Admin</a></li>
                                <li><hr class="dropdown-divider"></li>
                            @endif
                            <li><a class="dropdown-item" href="{{ route('orders.index') }}"><i class="bi bi-bag-check me-2"></i>Riwayat Belanja</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger"><i class="bi bi-box-arrow-right me-2"></i>Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn-bh-outline px-3 py-2">Masuk</a>
                    <a href="{{ route('register') }}" class="btn-bh-red px-3 py-2">Daftar</a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<main>
    <div class="container my-3">
        @if(session('success'))
            <div class="alert alert-success d-flex align-items-center gap-2 py-2">
                <i class="bi bi-check-circle-fill text-success"></i>
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger d-flex align-items-center gap-2 py-2">
                <i class="bi bi-exclamation-circle-fill text-danger"></i>
                {{ session('error') }}
            </div>
        @endif
    </div>

    @yield('content')
</main>

<footer class="py-5 mt-5">
    <div class="container">
        <div class="row gy-4">
            <div class="col-md-5">
                <div class="footer-brand mb-2">BeautyHouse <span class="text-white fw-light">by Salma</span></div>
                <p style="color: #64748b; font-size: 0.875rem;">Penyedia produk fashion, skincare berkualitas, dan kuliner lezat khas rumahan. Semua dalam satu tempat.</p>
            </div>
            <div class="col-md-3">
                <h6 class="text-white fw-semibold mb-3" style="font-size:0.8rem; letter-spacing:1px; text-transform:uppercase;">Kategori</h6>
                <ul class="list-unstyled" style="font-size:0.875rem;">
                    <li class="mb-1"><a href="{{ route('home') }}?category=Sunscreen" class="text-decoration-none" style="color:#64748b;">Sunscreen</a></li>
                    <li class="mb-1"><a href="{{ route('home') }}?category=Face+Wash" class="text-decoration-none" style="color:#64748b;">Face Wash</a></li>
                    <li class="mb-1"><a href="{{ route('home') }}?category=Scrub" class="text-decoration-none" style="color:#64748b;">Scrub</a></li>
                    <li class="mb-1"><a href="{{ route('home') }}?category=Serum" class="text-decoration-none" style="color:#64748b;">Serum</a></li>
                    <li class="mb-1"><a href="{{ route('home') }}?category=Fashion" class="text-decoration-none" style="color:#64748b;">Fashion & Style</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h6 class="text-white fw-semibold mb-3" style="font-size:0.8rem; letter-spacing:1px; text-transform:uppercase;">Kontak</h6>
                <ul class="list-unstyled" style="font-size:0.875rem; color:#64748b;">
                    <li class="mb-1"><i class="bi bi-envelope me-2 text-danger"></i>support@beautyhouse.com</li>
                    <li class="mb-1"><i class="bi bi-telephone me-2 text-danger"></i>+62 812-3456-789</li>
                    <li class="mb-1"><i class="bi bi-geo-alt me-2 text-danger"></i>Telkom University, Indonesia</li>
                </ul>
            </div>
        </div>
        <hr style="border-color: #334155; margin: 2rem 0;">
        <p class="text-center mb-0" style="color:#475569; font-size:0.8rem;">© {{ date('Y') }} BeautyHouse by Salma. Dibuat untuk tugas mata kuliah Manprosi.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')
</body>
</html>

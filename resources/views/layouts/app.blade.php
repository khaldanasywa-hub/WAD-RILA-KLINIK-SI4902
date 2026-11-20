
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Klinik Sehat')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<nav>
    <a href="#">Manajemen Pasien</a>
    <a href="{{ route('dokter.index') }}">Dokter &amp; Medis</a>
    <a href="#">Katalog Farmasi</a>
    <a href="{{ route('ruangan.index') }}" class="active">Ruang Poliklinik</a>

    @auth
        <form method="POST" action="{{ route('logout') }}" style="display:flex; align-items:center; gap:10px; margin:0;">
            @csrf
            <span>{{ auth()->user()->name }} ({{ auth()->user()->role }})</span>
            <button type="submit" class="btn btn-secondary">Logout</button>
        </form>
    @endauth
</nav>

<div class="container @yield('lebar')">
    @if (session('sukses'))
        <div class="alert alert-success">{{ session('sukses') }}</div>
    @endif

    @yield('content')
</div>

@stack('scripts')

</body>
</html>

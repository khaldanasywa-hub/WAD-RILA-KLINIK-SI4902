<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>@yield('title') - Poliklinik</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<nav>
  <a href="#">Manajemen Pasien</a> |
  <a href="#">Dokter &amp; Medis</a> |
  <a href="#">Katalog Farmasi</a> |
  <a href="{{ route('ruangan.index') }}" class="active">Ruang Poliklinik</a>
</nav>

@if (session('sukses'))
  <div class="alert alert-success">{{ session('sukses') }}</div>
@endif

@yield('content')

</body>
</html>

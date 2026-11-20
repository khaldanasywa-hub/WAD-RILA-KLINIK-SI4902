@extends('layouts.app')

@section('title', 'Ruang Poliklinik - Daftar')

@section('content')
<div class="header">
  <div>
    <h1>Ruang Poliklinik</h1>
    <p style="color:#64748b; font-size:14px;">Data ruangan poli, lokasi gedung, dan inventaris alat medis.</p>
  </div>
  <a href="{{ route('ruangan.create') }}" class="btn btn-primary">+ Tambah Ruangan</a>
</div>

<div class="filter-card">
  <form class="filter-form" method="get" action="{{ route('ruangan.index') }}">
    <input type="text" name="cari" value="{{ $cari }}" placeholder="Cari nama ruangan atau gedung...">
    <select name="jenis">
      <option value="">Semua Jenis Poli</option>
      <option value="Poli Gigi" @selected($jenis == 'Poli Gigi')>Poli Gigi</option>
      <option value="Poli Umum" @selected($jenis == 'Poli Umum')>Poli Umum</option>
    </select>
    <button type="submit" class="btn btn-primary">Cari</button>
  </form>
</div>

<table>
  <thead>
    <tr>
      <th>Nama Ruangan</th><th>Jenis Poli</th><th>Lokasi Gedung</th>
      <th>Inventaris Alat</th><th>Status</th><th>Aksi</th>
    </tr>
  </thead>
  <tbody>
  @forelse ($ruangan as $r)
    <tr>
      <td>{{ $r->nama_ruangan }}</td>
      <td>{{ str_replace('Poli ', '', $r->jenis_poli) }}</td>
      <td>{{ $r->lokasi_gedung }} - {{ $r->lantai }}</td>
      <td>{{ (int) $r->inventaris_sum_jumlah }} alat</td>
      <td><span class="badge {{ $r->status == 'Aktif' ? 'badge-success' : 'badge-warning' }}">{{ $r->status }}</span></td>
      <td>
        <a href="{{ route('ruangan.edit', $r) }}" class="action">Ubah</a> |
        <form class="inline" method="post" action="{{ route('ruangan.destroy', $r) }}"
              onsubmit="return confirm('Yakin hapus ruangan ini?')">
          @csrf
          @method('DELETE')
          <button type="submit" class="action" style="color:#dc2626;">Hapus</button>
        </form>
      </td>
    </tr>
  @empty
    <tr><td colspan="6" style="text-align:center;">Data tidak ditemukan.</td></tr>
  @endforelse
  </tbody>
</table>
@endsection

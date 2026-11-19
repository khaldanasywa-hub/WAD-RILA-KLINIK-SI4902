@extends('layouts.app')

@php
  $edit  = $ruangan !== null;
  $judul = $edit ? 'Ubah Ruangan' : 'Tambah Ruangan';

  // Baris inventaris: dari input sebelumnya (jika validasi gagal) > dari database > 1 baris kosong
  if (old('alat_nama')) {
      $baris = [];
      foreach (old('alat_nama') as $i => $nama) {
          $baris[] = ['nama' => $nama, 'jumlah' => old("alat_jumlah.$i"), 'kondisi' => old("alat_kondisi.$i", 'Baik')];
      }
  } elseif ($edit && $ruangan->inventaris->count()) {
      $baris = $ruangan->inventaris->map(fn ($a) => ['nama' => $a->nama_alat, 'jumlah' => $a->jumlah, 'kondisi' => $a->kondisi])->all();
  } else {
      $baris = [['nama' => '', 'jumlah' => '', 'kondisi' => 'Baik']];
  }
@endphp

@section('title', $judul)

@section('content')
<p class="breadcrumb"><a href="{{ route('ruangan.index') }}">Ruang Poliklinik</a> / {{ $judul }}</p>
<h1>{{ $judul }}</h1>

@if ($errors->any())
  <div class="alert alert-error">
    @foreach ($errors->all() as $e) <div>{{ $e }}</div> @endforeach
  </div>
@endif

<div class="card">
  <form method="post" action="{{ $edit ? route('ruangan.update', $ruangan) : route('ruangan.store') }}">
    @csrf
    @if ($edit) @method('PUT') @endif

    <h2 style="font-size:18px; margin-bottom:16px;">Informasi Ruangan</h2>

    <div class="form-group">
      <label>Nama Ruangan</label>
      <input type="text" name="nama_ruangan" value="{{ old('nama_ruangan', $ruangan->nama_ruangan ?? '') }}" placeholder="Contoh: Poli Gigi 1" required>
    </div>

    <div class="form-group">
      <label>Jenis Poli</label>
      <select name="jenis_poli" required>
        <option value="">Pilih jenis poli</option>
        @foreach (['Poli Gigi', 'Poli Umum'] as $j)
          <option @selected(old('jenis_poli', $ruangan->jenis_poli ?? '') == $j)>{{ $j }}</option>
        @endforeach
      </select>
    </div>

    <div class="form-group">
      <label>Lokasi Gedung</label>
      <input type="text" name="lokasi_gedung" value="{{ old('lokasi_gedung', $ruangan->lokasi_gedung ?? '') }}" placeholder="Contoh: Gedung A" required>
    </div>

    <div class="form-group">
      <label>Lantai</label>
      <input type="text" name="lantai" value="{{ old('lantai', $ruangan->lantai ?? '') }}" placeholder="Contoh: Lantai 2" required>
    </div>

    <div class="form-group">
      <label>Status Ruangan</label>
      <select name="status">
        @foreach (['Aktif', 'Perawatan', 'Tidak Aktif'] as $s)
          <option @selected(old('status', $ruangan->status ?? 'Aktif') == $s)>{{ $s }}</option>
        @endforeach
      </select>
    </div>

    <hr>
    <h2 style="font-size:18px; margin-bottom:16px;">Inventaris Alat Medis</h2>

    <table>
      <thead><tr><th>Nama Alat</th><th>Jumlah</th><th>Kondisi</th><th></th></tr></thead>
      <tbody id="invBody">
      @foreach ($baris as $b)
        <tr>
          <td><input type="text" name="alat_nama[]" value="{{ $b['nama'] }}" placeholder="Contoh: Dental Chair"></td>
          <td><input type="number" name="alat_jumlah[]" value="{{ $b['jumlah'] }}" placeholder="0" min="0"></td>
          <td>
            <select name="alat_kondisi[]">
              @foreach (['Baik', 'Perlu Servis', 'Rusak'] as $k)
                <option @selected($b['kondisi'] == $k)>{{ $k }}</option>
              @endforeach
            </select>
          </td>
          <td><button type="button" style="background:#fee2e2; color:#dc2626; border:none; padding:6px 12px; border-radius:4px; cursor:pointer;" onclick="hapusBaris(this)">Hapus</button></td>
        </tr>
      @endforeach
      </tbody>
    </table>

    <button type="button" class="btn btn-secondary" onclick="addRow()">+ Tambah Alat</button>
    <hr>
    <div>
      <button type="submit" class="btn btn-primary">Simpan Ruangan</button>
      <a href="{{ route('ruangan.index') }}" class="btn btn-cancel">Batal</a>
    </div>
  </form>
</div>

<script>
  function addRow() {
    const body = document.getElementById('invBody');
    const row = body.rows[0].cloneNode(true);
    row.querySelectorAll('input').forEach(i => i.value = '');
    body.appendChild(row);
  }
  function hapusBaris(btn) {
    const body = document.getElementById('invBody');
    if (body.rows.length > 1) btn.closest('tr').remove();
  }
</script>
@endsection


@extends('layouts.app')

@section('title', 'Katalog Farmasi')
@section('lebar', 'lebar')

@section('content')

<div class="header-halaman">
    <div>
        <h2>Katalog Farmasi Klinik Rawat Jalan</h2>
        <p class="teks-redup">Kelola dan lihat data persediaan obat klinik.</p>
    </div>

    <a href="{{ route('obat.create') }}" class="btn btn-primary">
        + Tambah Obat
    </a>
</div>

<div class="card farmasi-card">

    <div class="farmasi-search">
        <input
            type="text"
            id="searchInput"
            placeholder="Cari nama obat, kategori, atau pabrikan..."
        >

        <button type="button" class="btn btn-primary" onclick="cariObat()">
            Cari
        </button>
    </div>

    <div class="tabel-wrap">
        <table id="tabelObat">
            <thead>
                <tr>
                    <th>Nama Obat</th>
                    <th>Kategori Obat</th>
                    <th>Sediaan</th>
                    <th>Stok</th>
                    <th>Harga</th>
                    <th>Pabrikan</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($obat as $row)
                    <tr>
                        <td>{{ $row->nama_obat }}</td>
                        <td>{{ $row->kategori }}</td>
                        <td>{{ $row->sediaan }}</td>
                        <td>{{ $row->stok }}</td>
                        <td>Rp {{ number_format($row->harga, 0, ',', '.') }}</td>
                        <td>{{ $row->pabrikan }}</td>
                        <td>
                            <div class="aksi">
                                <a
                                    href="{{ route('obat.edit', $row->id) }}"
                                    class="btn btn-sm btn-edit"
                                >
                                    Edit
                                </a>

                                <form
                                    action="{{ route('obat.destroy', $row->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus obat ini?')"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-sm btn-hapus">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="tengah">
                            Belum ada data obat.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function cariObat() {
        const keyword = document
            .getElementById('searchInput')
            .value.toLowerCase();

        const rows = document.querySelectorAll('#tabelObat tbody tr');

        rows.forEach(function(row) {
            row.style.display = row.innerText.toLowerCase().includes(keyword)
                ? ''
                : 'none';
        });
    }

    document.getElementById('searchInput').addEventListener('input', cariObat);
</script>
@endpush

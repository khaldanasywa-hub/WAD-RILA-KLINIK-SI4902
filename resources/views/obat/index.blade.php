
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Farmasi</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <header class="square">
        <h1>Katalog Farmasi Klinik Rawat Jalan</h1>
        <p class="page-subtitle">
            Kelola dan lihat data persediaan obat klinik.
        </p>
    </header>

    <div class="search-section">
        <input type="text" id="searchInput"
               placeholder="Cari nama obat...">
        <button type="button" onclick="cariObat()">
            Cari
        </button>
    </div>

    <div class="add-section">
        <a class="btn" href="{{ route('obat.create') }}">
            + Tambah Obat
        </a>
    </div>

    <div class="table-wrapper">
        <table>
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
                    <td>{{ $row->harga }}</td>
                    <td>{{ $row->pabrikan }}</td>

                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('obat.edit', $row->id) }}">
                                <button type="button" class="btn-edit">
                                    Edit
                                </button>
                            </a>

                            <form action="{{ route('obat.destroy', $row->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Ingin menghapus data obat ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="7" style="text-align:center;">
                        Belum ada data obat.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <script>
        function cariObat() {
            const keyword = document.getElementById('searchInput').value.toLowerCase();
            const rows = document.querySelectorAll('tbody tr');

            rows.forEach(function(row) {
                row.style.display =
                    row.innerText.toLowerCase().includes(keyword) ? '' : 'none';
            });
        }

        document.getElementById('searchInput').addEventListener('keyup', cariObat);
    </script>

</body>
</html>

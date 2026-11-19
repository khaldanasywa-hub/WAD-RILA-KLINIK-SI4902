
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($obat) ? 'Edit Data Obat' : 'Tambah Data Obat' }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <div class="square">
        <h1>{{ isset($obat) ? 'Edit Data Obat' : 'Tambah Data Obat' }}</h1>
        <p class="page-subtitle">
            {{ isset($obat) ? 'Perbarui informasi obat pada katalog farmasi.' : 'Tambahkan informasi obat ke katalog farmasi.' }}
        </p>
    </div>

    <div class="form-section">

        <form action="{{ isset($obat) ? route('obat.update', $obat->id) : route('obat.store') }}"
              method="POST">

            @csrf

            @if(isset($obat))
                @method('PUT')
            @endif

            <div class="form-group full-width">
                <label for="nama_obat">Nama Obat</label>
                <input type="text" id="nama_obat" name="nama_obat"
                    value="{{ old('nama_obat', $obat->nama_obat ?? '') }}" required>
            </div>

            <div class="form-group">
                <label for="kategori">Kategori Obat</label>
                <input type="text" id="kategori" name="kategori"
                    value="{{ old('kategori', $obat->kategori ?? '') }}" required>
            </div>

            <div class="form-group">
                <label for="sediaan">Sediaan</label>
                <select id="sediaan" name="sediaan" required>
                    <option value="">Pilih Sediaan</option>
                    @foreach(['Sirup', 'Tablet', 'Kapsul'] as $jenis)
                        <option value="{{ $jenis }}"
                            {{ old('sediaan', $obat->sediaan ?? '') == $jenis ? 'selected' : '' }}>
                            {{ $jenis }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="stok">Stok</label>
                <input type="number" id="stok" name="stok"
                    value="{{ old('stok', $obat->stok ?? '') }}" min="0" required>
            </div>

            <div class="form-group">
                <label for="harga">Harga</label>
                <input type="number" id="harga" name="harga"
                    value="{{ old('harga', $obat->harga ?? '') }}" min="0" required>
            </div>

            <div class="form-group full-width">
                <label for="pabrikan">Pabrikan</label>
                <input type="text" id="pabrikan" name="pabrikan"
                    value="{{ old('pabrikan', $obat->pabrikan ?? '') }}" required>
            </div>

            <div class="form-actions">
                <button type="submit">
                    {{ isset($obat) ? 'Simpan Perubahan' : 'Tambah Obat' }}
                </button>

                <a class="btn btn-secondary" href="{{ route('obat.index') }}">
                    Batal
                </a>
            </div>

        </form>
    </div>

</body>
</html>

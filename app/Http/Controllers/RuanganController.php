<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RuanganController extends Controller
{

    public function index(Request $request)
    {
        $cari  = $request->input('cari', '');
        $jenis = $request->input('jenis', '');

        $ruangan = Ruangan::withSum('inventaris', 'jumlah') 
            ->when($cari, function ($q) use ($cari) {
                $q->where(function ($q) use ($cari) {
                    $q->where('nama_ruangan', 'like', "%$cari%")
                      ->orWhere('lokasi_gedung', 'like', "%$cari%");
                });
            })
            ->when($jenis, fn ($q) => $q->where('jenis_poli', $jenis))
            ->orderBy('id')
            ->get();

        return view('ruangan.index', compact('ruangan', 'cari', 'jenis'));
    }

    
    public function create()
    {
        return view('ruangan.form', ['ruangan' => null]);
    }

    
    public function store(Request $request)
    {
        $data = $this->validasi($request);

        DB::transaction(function () use ($data, $request) {
            $ruangan = Ruangan::create($data);
            $this->simpanAlat($ruangan, $request);
        });

        return redirect()->route('ruangan.index')->with('sukses', 'Data ruangan berhasil disimpan!');
    }

    
    public function edit(Ruangan $ruangan)
    {
        $ruangan->load('inventaris');
        return view('ruangan.form', compact('ruangan'));
    }

    // UPDATE
    public function update(Request $request, Ruangan $ruangan)
    {
        $data = $this->validasi($request);

        DB::transaction(function () use ($data, $request, $ruangan) {
            $ruangan->update($data);
            $ruangan->inventaris()->delete(); 
            $this->simpanAlat($ruangan, $request);
        });

        return redirect()->route('ruangan.index')->with('sukses', 'Data ruangan berhasil diperbarui!');
    }

    
    public function destroy(Ruangan $ruangan)
    {
        $ruangan->delete(); 
        return redirect()->route('ruangan.index')->with('sukses', 'Data berhasil dihapus!');
    }

    private function validasi(Request $request): array
    {
        return $request->validate([
            'nama_ruangan'  => 'required|max:100',
            'jenis_poli'    => 'required|in:Poli Gigi,Poli Umum',
            'lokasi_gedung' => 'required|max:100',
            'lantai'        => 'required|max:50',
            'status'        => 'required|in:Aktif,Perawatan,Tidak Aktif',
            'alat_nama'     => 'nullable|array',
            'alat_jumlah'   => 'nullable|array',
            'alat_jumlah.*' => 'nullable|integer|min:0',
            'alat_kondisi'  => 'nullable|array',
        ]);
    }

    private function simpanAlat(Ruangan $ruangan, Request $request): void
    {
        foreach ($request->input('alat_nama', []) as $i => $nama) {
            if (trim((string) $nama) === '') continue; 
            $ruangan->inventaris()->create([
                'nama_alat' => $nama,
                'jumlah'    => (int) ($request->input("alat_jumlah.$i") ?? 0),
                'kondisi'   => $request->input("alat_kondisi.$i", 'Baik'),
            ]);
        }
    }
}

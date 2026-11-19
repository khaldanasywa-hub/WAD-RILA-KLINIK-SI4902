<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat;

class ObatController extends Controller
{
    public function index()
    {
        $obat = Obat::all();

        return view('obat.index', compact('obat'));
    }

    public function create()
    {
        return view('obat.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_obat' => 'required',
            'kategori' => 'required',
            'sediaan' => 'required',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
            'pabrikan' => 'required'
        ]);

        Obat::create($request->only([
            'nama_obat',
            'kategori',
            'sediaan',
            'stok',
            'harga',
            'pabrikan'
        ]));

        return redirect()->route('obat.index');
    }

    public function edit($id)
    {
        $obat = Obat::findOrFail($id);

        return view('obat.form', compact('obat'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_obat' => 'required',
            'kategori' => 'required',
            'sediaan' => 'required',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
            'pabrikan' => 'required'
        ]);

        $obat = Obat::findOrFail($id);

        $obat->update($request->only([
            'nama_obat',
            'kategori',
            'sediaan',
            'stok',
            'harga',
            'pabrikan'
        ]));

        return redirect()->route('obat.index');
    }

    public function destroy($id)
    {
        $obat = Obat::findOrFail($id);
        $obat->delete();

        return redirect()->route('obat.index');
    }
}

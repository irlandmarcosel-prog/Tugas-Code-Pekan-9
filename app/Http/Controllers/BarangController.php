<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    // Menampilkan daftar barang
    public function index()
    {
        $barangs = Barang::all();

        return view('barang.index', compact('barangs'));
    }

    // Menampilkan form tambah barang
    public function create()
    {
        return view('barang.create');
    }

    // Menyimpan barang baru
    public function store(Request $request)
    {
        $data = $request->validate([
            'kode_barang' => 'required|max:50',
            'nama_barang' => 'required|max:100',
            'kategori' => 'required|max:100',
            'satuan' => 'required|max:50',
            'spesifikasi' => 'nullable|string',
        ]);

        Barang::create($data);

        return redirect()
            ->route('barang.index')
            ->with('success', 'Barang berhasil ditambahkan.');
    }

    // Menampilkan form edit barang
    public function edit(string $id)
    {
        $barang = Barang::findOrFail($id);

        return view('barang.edit', compact('barang'));
    }

    // Memperbarui data barang
    public function update(Request $request, string $id)
    {
        $barang = Barang::findOrFail($id);

        $data = $request->validate([
            'kode_barang' => 'required|max:50',
            'nama_barang' => 'required|max:100',
            'kategori' => 'required|max:100',
            'satuan' => 'required|max:50',
            'spesifikasi' => 'nullable|string',
        ]);

        $barang->update($data);

        return redirect()
            ->route('barang.index')
            ->with('success', 'Barang berhasil diperbarui.');
    }

    // Menghapus barang (khusus admin)
    public function destroy(string $id)
    {
        // Memeriksa hak akses pengguna
        if (auth()->user()->role !== 'admin') {
            return redirect()
                ->route('barang.index')
                ->with('error', 'Anda tidak memiliki akses untuk menghapus barang.');
        }

        // Mencari barang berdasarkan ID
        $barang = Barang::findOrFail($id);

        // Menghapus barang
        $barang->delete();

        return redirect()
            ->route('barang.index')
            ->with('success', 'Barang berhasil dihapus.');
    }
}

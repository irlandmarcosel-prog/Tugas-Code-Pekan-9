<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Barang</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <h1>Edit Barang</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form
        action="{{ route('barang.update', $barang->id_barang) }}"
        method="POST"
    >
        @csrf
        @method('PUT')

        <label>Kode Barang</label><br>
        <input name="kode_barang"
               value="{{ old('kode_barang', $barang->kode_barang) }}"
               required>
        <br><br>

        <label>Nama Barang</label><br>
        <input name="nama_barang"
               value="{{ old('nama_barang', $barang->nama_barang) }}"
               required>
        <br><br>

        <label>Kategori</label><br>
        <input
            name="kategori"
            list="daftar-kategori"
            value="{{ old('kategori', $barang->kategori) }}"
            placeholder="Pilih atau ketik kategori"
            required
>
        <datalist id="daftar-kategori">
            <option value="Elektronik">
            <option value="Peralatan ">
            <option value="Jaringan">
        </datalist>
        <br><br>

        <label>Satuan</label><br>
        <input
            name="satuan"
            list="daftar-satuan"
            value="{{ old('satuan', $barang->satuan) }}"
            placeholder="Pilih atau ketik satuan"
            required
>
        <datalist id="daftar-satuan">
            <option value="Pcs">
            <option value="Unit">
            <option value="Box">
            <option value="Meter">
            <option value="Kg">
        </datalist>
        <br><br>


        <label>Spesifikasi</label><br>
        <textarea name="spesifikasi">{{ old('spesifikasi', $barang->spesifikasi) }}</textarea>
        <br><br>

        <button type="submit">Simpan Perubahan</button>
        <a href="{{ route('barang.index') }}">Kembali</a>
    </form>
</body>
</html>
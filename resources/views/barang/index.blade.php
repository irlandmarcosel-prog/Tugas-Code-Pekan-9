
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Katalog Barang</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <h1>Katalog Barang</h1>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    @if (session('error'))
        <p style="color: red;">
            {{ session('error') }}
        </p>
    @endif

    <div style="margin-bottom: 20px;">
        <a href="{{ route('barang.create') }}">+ Tambah Barang</a>

        <form action="{{ route('logout') }}" method="POST" style="display:inline; margin-left: 15px;">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Satuan</th>
                <th>Spesifikasi</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($barangs as $barang)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $barang->kode_barang }}</td>
                    <td>{{ $barang->nama_barang }}</td>
                    <td>{{ $barang->kategori }}</td>
                    <td>{{ $barang->satuan }}</td>
                    <td>{{ $barang->spesifikasi }}</td>

                    <td>
                        {{-- Tombol Edit tersedia untuk Admin dan Staff --}}
                        <a href="{{ route('barang.edit', $barang->id_barang) }}">
                            Edit
                        </a>

                        {{-- Tombol Hapus hanya tersedia untuk Admin --}}
                        @if (Auth::user()->role === 'admin')
                            <form
                                action="{{ route('barang.destroy', $barang->id_barang) }}"
                                method="POST"
                                style="display:inline"
                                onsubmit="return confirm('Yakin ingin menghapus barang ini?')"
                            >
                                @csrf
                                @method('DELETE')

                                <button type="submit">Hapus</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Belum ada data barang.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>

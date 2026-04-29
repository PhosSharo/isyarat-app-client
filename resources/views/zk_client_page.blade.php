<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>zk client page</title>
</head>
<body>
    <h1>Data JSON dari API</h1>
    
    @if (isset($error) && $error)
        <p>{{ $error }}</p>
    @endif

    <pre>{{ $rawJson ?? '[]' }}</pre>

    <h2>Tabel dari API Kelompok</h2>
    <table border="1" cellpadding="6" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>npm</th>
                <th>nama</th>
                <th>prodi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($hasil as $i => $item)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $item['rd_npm'] ?? '' }}</td>
                    <td>{{ $item['rd_nama'] ?? '' }}</td>
                    <td>{{ $item['rd_prodi'] ?? '' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Tidak ad    a data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>

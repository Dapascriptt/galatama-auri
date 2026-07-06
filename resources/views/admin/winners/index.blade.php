@extends('layouts.admin')

@section('title', 'Pemenang')

@section('content')
    <div class="admin-card">
        <div class="table-toolbar">
            <form method="GET" class="search-form">
                <input name="search" value="{{ $search }}" placeholder="Cari nama pemenang">
                <button class="btn btn-outline" type="submit">Search</button>
            </form>
            <a class="btn btn-primary" href="{{ route('admin.winners.create') }}">Tambah</a>
        </div>
        <div class="table-wrap">
            <table>
                <thead><tr><th>Nama</th><th>Kategori</th><th>Juara</th><th>Hasil</th><th>Status</th><th>Aksi</th></tr></thead>
                <tbody>
                    @forelse($winners as $winner)
                        <tr>
                            <td><strong>{{ $winner->name }}</strong></td>
                            <td>{{ $winner->category ?: '-' }}</td>
                            <td>{{ $winner->rank ? (\App\Models\Winner::RANKS[$winner->rank] ?? $winner->rank) : '-' }}</td>
                            <td>{{ $winner->value ?: '-' }}</td>
                            <td>{{ $winner->is_active ? 'Aktif' : 'Nonaktif' }}</td>
                            <td class="row-actions">
                                <a href="{{ route('admin.winners.edit', $winner) }}">Edit</a>
                                <form method="POST" action="{{ route('admin.winners.destroy', $winner) }}" onsubmit="return confirm('Hapus pemenang ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6">Belum ada pemenang. Klik "Tambah" untuk mengisi juara per kategori.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $winners->links() }}
    </div>
@endsection

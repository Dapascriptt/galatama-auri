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
        <div class="admin-gallery">
            @forelse($winners as $winner)
                @php
                    $src = Illuminate\Support\Str::startsWith($winner->image, ['http://', 'https://']) ? $winner->image : asset('storage/'.$winner->image);
                @endphp
                <article>
                    <img src="{{ $src }}" alt="{{ $winner->caption ?: 'Pemenang' }}" width="220" height="150" loading="lazy">
                    <strong>{{ $winner->caption ?: 'Tanpa keterangan' }}</strong>
                    <span>{{ $winner->is_active ? 'Aktif' : 'Nonaktif' }} - Urutan {{ $winner->sort_order }}</span>
                    <div class="row-actions">
                        <a href="{{ route('admin.winners.edit', $winner) }}">Edit</a>
                        <form method="POST" action="{{ route('admin.winners.destroy', $winner) }}" onsubmit="return confirm('Hapus foto pemenang ini?')">
                            @csrf @method('DELETE')
                            <button type="submit">Hapus</button>
                        </form>
                    </div>
                </article>
            @empty
                <p>Belum ada foto pemenang. Klik "Tambah" untuk mengunggah foto pemenang galatama harian.</p>
            @endforelse
        </div>
        {{ $winners->links() }}
    </div>
@endsection

@php
    use Illuminate\Support\Str;
    $imageUrl = fn (?string $path) => $path ? (Str::startsWith($path, ['http://', 'https://']) ? $path : asset('storage/'.$path)) : null;
@endphp

<label>Foto Pemenang
    <input type="file" name="image" accept="image/png,image/jpeg,image/webp" @required(! $winner->exists)>
    @if($imageUrl($winner->image))
        <img class="preview-img" src="{{ $imageUrl($winner->image) }}" alt="{{ $winner->caption }}" width="160" height="110" loading="lazy">
    @endif
    @error('image') <small class="form-error">{{ $message }}</small> @enderror
</label>
<label>Keterangan (nama pemenang / sesi)
    <input name="caption" value="{{ old('caption', $winner->caption) }}" placeholder="cth: Pak Budi - Juara 1, Sesi 21 Juni">
</label>
<label>Urutan
    <input type="number" min="0" name="sort_order" value="{{ old('sort_order', $winner->sort_order ?? 0) }}">
</label>
<label class="check-row">
    <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $winner->is_active ?? true))>
    Tampilkan di website
</label>
<div class="form-actions">
    <button class="btn btn-primary" type="submit">Simpan</button>
    <a class="btn btn-outline" href="{{ route('admin.winners.index') }}">Batal</a>
</div>

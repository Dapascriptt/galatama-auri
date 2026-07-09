<label>Nama Peserta
    <input name="name" value="{{ old('name', $participant->name) }}" required>
    @error('name') <small class="form-error">{{ $message }}</small> @enderror
</label>
<fieldset class="check-group">
    <legend>Kategori (boleh pilih lebih dari satu)</legend>
    <div class="check-grid">
        @foreach(\App\Models\Participant::CATEGORIES as $category)
            <label class="check-row">
                <input type="checkbox" name="categories[]" value="{{ $category }}" @checked(in_array($category, old('categories', $participant->categories ?? []), true))>
                {{ $category }}
            </label>
        @endforeach
    </div>
    @error('categories') <small class="form-error">{{ $message }}</small> @enderror
    @error('categories.*') <small class="form-error">{{ $message }}</small> @enderror
</fieldset>
<label>Nomor WhatsApp / Telepon
    <input name="phone" value="{{ old('phone', $participant->phone) }}">
</label>
<label>Urutan
    <input type="number" min="0" name="sort_order" value="{{ old('sort_order', $participant->sort_order ?? 0) }}">
</label>
<label>Catatan
    <input name="note" value="{{ old('note', $participant->note) }}" placeholder="Contoh: Meja 01, komunitas, atau status pembayaran">
</label>
<label class="check-row">
    <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $participant->is_active ?? true))>
    Tampilkan di website
</label>
<div class="form-actions">
    <button class="btn btn-primary" type="submit">Simpan</button>
    <a class="btn btn-outline" href="{{ route('admin.participants.index') }}">Batal</a>
</div>

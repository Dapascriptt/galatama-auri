<label>Nama Pemenang
    <input name="name" value="{{ old('name', $winner->name) }}" required placeholder="cth: Pak Budi">
    @error('name') <small class="form-error">{{ $message }}</small> @enderror
</label>
<div class="form-grid two">
    <label>Kategori (opsional, sesuai sesi)
        <select name="category">
            <option value="">Tanpa kategori</option>
            @foreach(\App\Models\Winner::CATEGORIES as $category)
                <option value="{{ $category }}" @selected(old('category', $winner->category) === $category)>{{ $category }} — {{ \App\Models\Winner::METRICS[$category] }}</option>
            @endforeach
        </select>
        @error('category') <small class="form-error">{{ $message }}</small> @enderror
    </label>
    <label>Juara
        <select name="rank">
            <option value="">Tanpa gelar</option>
            @foreach(\App\Models\Winner::RANKS as $value => $label)
                <option value="{{ $value }}" @selected(old('rank', $winner->rank) === (string) $value)>{{ $label }}</option>
            @endforeach
        </select>
        @error('rank') <small class="form-error">{{ $message }}</small> @enderror
    </label>
</div>
<label>Hasil
    <input name="value" value="{{ old('value', $winner->value) }}" placeholder="cth: 4,2 kg (kategori A/C) atau 35 ekor (kategori BS)">
    @error('value') <small class="form-error">{{ $message }}</small> @enderror
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

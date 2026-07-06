<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\ManagesUploads;
use App\Http\Controllers\Controller;
use App\Models\Winner;
use Illuminate\Http\Request;

class WinnerController extends Controller
{
    use ManagesUploads;

    public function index(Request $request)
    {
        $search = $request->string('search')->toString();

        $winners = Winner::query()
            ->when($search, fn ($query) => $query->where('caption', 'like', "%{$search}%"))
            ->orderBy('sort_order')
            ->latest('id')
            ->paginate(12)
            ->withQueryString();

        return view('admin.winners.index', compact('winners', 'search'));
    }

    public function create()
    {
        return view('admin.winners.create', ['winner' => new Winner()]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request, true);
        $data['image'] = $this->storePublicImage($request->file('image'), 'winners');

        Winner::create($data);

        return redirect()->route('admin.winners.index')->with('success', 'Foto pemenang berhasil ditambahkan.');
    }

    public function edit(Winner $winner)
    {
        return view('admin.winners.edit', compact('winner'));
    }

    public function update(Request $request, Winner $winner)
    {
        $data = $this->validated($request);

        if ($request->hasFile('image')) {
            $this->deletePublicImage($winner->image);
            $data['image'] = $this->storePublicImage($request->file('image'), 'winners');
        }

        $winner->update($data);

        return redirect()->route('admin.winners.index')->with('success', 'Foto pemenang berhasil diperbarui.');
    }

    public function destroy(Winner $winner)
    {
        $this->deletePublicImage($winner->image);
        $winner->delete();

        return back()->with('success', 'Foto pemenang berhasil dihapus.');
    }

    private function validated(Request $request, bool $requireImage = false): array
    {
        $data = $request->validate([
            'caption' => ['nullable', 'string', 'max:160'],
            'image' => [$requireImage ? 'required' : 'nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:999'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_active'] = $request->boolean('is_active');

        return $data;
    }
}

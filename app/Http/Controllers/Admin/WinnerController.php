<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Winner;
use Illuminate\Http\Request;

class WinnerController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->string('search')->toString();

        $winners = Winner::query()
            ->when($search, fn ($query) => $query->where('name', 'like', "%{$search}%"))
            ->orderBy('category')
            ->orderBy('sort_order')
            ->latest('id')
            ->paginate(15)
            ->withQueryString();

        return view('admin.winners.index', compact('winners', 'search'));
    }

    public function create()
    {
        return view('admin.winners.create', ['winner' => new Winner()]);
    }

    public function store(Request $request)
    {
        Winner::create($this->validated($request));

        return redirect()->route('admin.winners.index')->with('success', 'Pemenang berhasil ditambahkan.');
    }

    public function edit(Winner $winner)
    {
        return view('admin.winners.edit', compact('winner'));
    }

    public function update(Request $request, Winner $winner)
    {
        $winner->update($this->validated($request));

        return redirect()->route('admin.winners.index')->with('success', 'Pemenang berhasil diperbarui.');
    }

    public function destroy(Winner $winner)
    {
        $winner->delete();

        return back()->with('success', 'Pemenang berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'category' => ['nullable', 'in:'.implode(',', Winner::CATEGORIES)],
            'rank' => ['nullable', 'in:'.implode(',', array_keys(Winner::RANKS))],
            'value' => ['nullable', 'string', 'max:60'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:999'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['category'] = $data['category'] ?? null;
        $data['rank'] = $data['rank'] ?? null;
        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_active'] = $request->boolean('is_active');

        return $data;
    }
}

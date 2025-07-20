<?php

namespace App\Http\Controllers;

use App\Models\ItemCategory;
use Illuminate\Http\Request;

class ItemCategoryController extends Controller
{
    public function index()
    {
        $categories = ItemCategory::all();
        return view('item_categories.index', compact('categories'));
    }

    public function create()
    {
        return view('item_categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        ItemCategory::create($request->only('name'));

        return redirect()->route('item-categories.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function show(ItemCategory $itemCategory)
    {
        return view('item_categories.show', compact('itemCategory'));
    }

    public function edit(ItemCategory $itemCategory)
    {
        return view('item_categories.edit', compact('itemCategory'));
    }

    public function update(Request $request, ItemCategory $itemCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $itemCategory->update($request->only('name'));

        return redirect()->route('item-categories.index')->with('success', 'Kategori berhasil diupdate.');
    }

    public function destroy(ItemCategory $itemCategory)
    {
        $itemCategory->delete();

        return redirect()->route('item-categories.index')->with('success', 'Kategori berhasil dihapus.');
    }
}

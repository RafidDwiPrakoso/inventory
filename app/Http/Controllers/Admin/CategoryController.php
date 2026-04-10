<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ItemCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = ItemCategory::withCount('itemStocks')->latest()->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'division' => 'required|string',
        ]);

        ItemCategory::create($request->all());

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function edit(ItemCategory $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, ItemCategory $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'division' => 'required|string',
        ]);

        $category->update($request->all());

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil diperbarui!');
    }
}


<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ItemStock;
use App\Models\ItemCategory;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items = ItemStock::with('category')->latest()->get();
        return view('admin.items.index', compact('items'));
    }

    public function create()
    {
        $categories = ItemCategory::all();
        return view('admin.items.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:item_categories,id',
            'item_name' => 'required|string|max:255',
            'total_stock' => 'required|integer|min:1',
        ]);

        ItemStock::create([
            'category_id' => $request->category_id,
            'item_name' => $request->item_name,
            'total_stock' => $request->total_stock,
            'total_repaired' => 0,
            'total_borrowed' => 0
        ]);

        return redirect()->route('admin.items.index')->with('success', 'Barang berhasil ditambahkan!');
    }

    public function edit(ItemStock $item)
    {
        $categories = ItemCategory::all();
        return view('admin.items.edit', compact('item', 'categories'));
    }

    public function update(Request $request, ItemStock $item)
    {
        $request->validate([
            'category_id' => 'required|exists:item_categories,id',
            'item_name' => 'required|string|max:255',
            'total_stock' => 'required|integer|min:1',
            'new_broke_item' => 'nullable|integer|min:0'
        ]);

        $newBroke = $request->input('new_broke_item', 0);

        $totalRepairNanti = $item->total_repaired + $newBroke;

        if ($totalRepairNanti > $request->total_stock) {
            return back()->withErrors([
                'new_broke_item' => "Gagal! Total barang rusak ($totalRepairNanti) tidak boleh melebihi total fisik barang."
            ])->withInput();
        }

        $minimalFisik = $item->total_repaired + $item->total_borrowed;

        if ($request->total_stock < $minimalFisik) {
            return back()->withErrors([
                'total_stock' => "Gagal! Total fisik minimal harus $minimalFisik (karena ada $item->total_repaired rusak & $item->total_borrowed sedang dipinjam)."
            ])->withInput();
        }

        if ($newBroke > 0) {
            $item->total_repaired = $totalRepairNanti;
        }

        $item->category_id = $request->category_id;
        $item->item_name = $request->item_name;
        $item->total_stock = $request->total_stock;
        $item->save();

        return redirect()->route('admin.items.index')->with('success', 'Item berhasil diperbarui!');
    }

    public function lendingDetails(ItemStock $item)
    {
        $lendings = $item->borrowedItems()->with(['staff', 'returnedItem'])->latest()->get();
        return view('admin.items.lending_details', compact('item', 'lendings'));
    }
}

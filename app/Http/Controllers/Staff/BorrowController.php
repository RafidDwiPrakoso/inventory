<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\BorrowedItem;
use App\Models\ItemStock;
use App\Models\ReturnedItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Exports\BorrowExport;
use Maatwebsite\Excel\Facades\Excel;

class BorrowController extends Controller
{
    public function index()
    {
        // LOGIKA HIERARKI: Head Staff vs Staff Biasa
        if (Auth::user()->role === 'headstaff') {
            $borrows = BorrowedItem::with(['itemStock', 'returnedItem', 'staff'])->latest()->get();
        } else {
            $borrows = BorrowedItem::where('staff_id', Auth::id())
                ->with(['itemStock', 'returnedItem', 'staff'])
                ->latest()
                ->get();
        }

        return view('staff.borrows.index', compact('borrows'));
    }

    public function create()
    {
        $items = ItemStock::whereRaw('(total_stock - total_repaired - total_borrowed) > 0')->get();
        return view('staff.borrows.create', compact('items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:item_stocks,id',
            'name_of_borrower' => 'required|string|max:255',
            'total_item' => 'required|integer|min:1',
            'date' => 'required|date',
            'notes' => 'nullable|string'
        ]);

        $item = ItemStock::findOrFail($request->item_id);
        $availableStock = $item->total_stock - $item->total_repaired - $item->total_borrowed;

        if ($request->total_item > $availableStock) {
            return back()->withErrors(['total_item' => "Stok tidak cukup! Sisa tersedia: $availableStock"])->withInput();
        }

        BorrowedItem::create([
            'staff_id' => Auth::id(), // Pencatat barang keluar
            'item_id' => $request->item_id,
            'name_of_borrower' => $request->name_of_borrower,
            'total_item' => $request->total_item,
            'date' => $request->date,
            'notes' => $request->notes
        ]);

        $item->increment('total_borrowed', $request->total_item);

        return redirect()->route('staff.borrows.index')->with('success', 'Peminjaman berhasil dicatat!');
    }

    public function returnItem(Request $request, $id)
    {
        // LOGIKA HIERARKI RETURN
        if (Auth::user()->role === 'headstaff') {
            $borrow = BorrowedItem::findOrFail($id);
        } else {
            $borrow = BorrowedItem::where('staff_id', Auth::id())->findOrFail($id);
        }

        if ($borrow->returnedItem) {
            return back()->with('error', 'Barang ini sudah dikembalikan sebelumnya!');
        }

        $request->validate([
            'return_date' => 'required|date',
            'return_notes' => 'nullable|string'
        ]);

        // Catat pengembalian (Beserta siapa yang memprosesnya)
        ReturnedItem::create([
            'staff_id' => Auth::id(), // Pencatat barang masuk
            'borrowed_item_id' => $borrow->id,
            'return_date' => $request->return_date,
            'notes' => $request->return_notes
        ]);

        $borrow->itemStock->decrement('total_borrowed', $borrow->total_item);

        return back()->with('success', 'Barang berhasil dikembalikan!');
    }

    public function destroy($id)
    {
        // LOGIKA HIERARKI HAPUS
        if (Auth::user()->role === 'headstaff') {
            $borrow = BorrowedItem::findOrFail($id);
        } else {
            $borrow = BorrowedItem::where('staff_id', Auth::id())->findOrFail($id);
        }

        if (!$borrow->returnedItem) {
            $borrow->itemStock->decrement('total_borrowed', $borrow->total_item);
        }

        $borrow->delete();
        return back()->with('success', 'Catatan peminjaman berhasil dihapus!');
    }

    public function export()
    {
        return Excel::download(new BorrowExport, 'Data_Peminjaman.xlsx');
    }
}

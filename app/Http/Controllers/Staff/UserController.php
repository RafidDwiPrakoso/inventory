<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        // Hanya menampilkan user dengan role 'staff'
        $users = User::where('role', 'staff')->latest()->get();
        return view('staff.users.index', compact('users'));
    }

    public function create()
    {
        return view('staff.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'staff', // Paksa secara sistem menjadi staff
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('staff.users.index')->with('success', 'Akun Staff berhasil dibuat!');
    }

    public function edit(User $user)
    {
        // Keamanan ekstra: cegah jika staff mencoba iseng akses URL edit milik admin
        if ($user->role !== 'staff') {
            abort(403, 'Akses Ditolak! Anda hanya bisa mengedit sesama Staff.');
        }
        return view('staff.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        if ($user->role !== 'staff') abort(403, 'Akses Ditolak!');

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'new_password' => 'nullable|min:6'
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        // Jika form password baru diisi, ubah passwordnya
        if ($request->filled('new_password')) {
            $user->password = Hash::make($request->new_password);
        }

        $user->save();

        return redirect()->route('staff.users.index')->with('success', 'Data akun berhasil diperbarui!');
    }

    public function destroy(User $user)
    {
        if ($user->role !== 'staff') abort(403, 'Akses Ditolak!');

        $user->delete();
        return back()->with('success', 'Akun berhasil dihapus.');
    }
}

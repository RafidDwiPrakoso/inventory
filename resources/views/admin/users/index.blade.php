@extends('layouts.app')
@section('title', 'Kelola Users')
@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h5 class="mb-0 fw-bold">Data Pengguna Sistem</h5>
        <div>
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-circle"></i> Tambah Akun
            </a>
            <a href="{{ url('admin/users/export') }}" class="btn btn-success btn-sm">Export Excel</a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="5%">No</th>
                        <th>Nama Pengguna</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th width="15%" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $index => $u)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $u->name }}</td>
                        <td>{{ $u->email }}</td>
                        <td>
                            <span class="badge bg-{{ $u->role == 'admin' ? 'danger' : 'info' }}">
                                {{ ucfirst($u->role) }}
                            </span>
                        </td>
                        <td class="text-center">
                            <form action="{{ route('admin.users.destroy', $u->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus akun ini?');">
                                <a href="{{ route('admin.users.edit', $u->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i></a>
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

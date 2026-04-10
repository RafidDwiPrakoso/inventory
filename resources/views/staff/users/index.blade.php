@extends('layouts.app')
@section('title', 'Kelola Rekan Staff')
@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h5 class="mb-0 fw-bold">Data Rekan Staff</h5>
        <a href="{{ route('staff.users.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle"></i> Tambah Akun Staff
        </a>
    </div>
    <div class="card-body">

        @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
        @if(session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="5%">No</th>
                        <th>Nama Pengguna</th>
                        <th>Email</th>
                        <th width="15%" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $index => $u)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $u->name }} @if(auth()->id() == $u->id) <span class="badge bg-success">Anda</span> @endif</td>
                        <td>{{ $u->email }}</td>
                        <td class="text-center">
                            <form action="{{ route('staff.users.destroy', $u->id) }}" method="POST" onsubmit="return confirm('Yakin hapus akun ini?');">
                                <a href="{{ route('staff.users.edit', $u->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i></a>
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" {{ auth()->id() == $u->id ? 'disabled' : '' }}><i class="bi bi-trash"></i></button>
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

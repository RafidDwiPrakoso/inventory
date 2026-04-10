<?php

namespace App\Exports\Admin;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UserExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return User::latest()->get();
    }

    public function map($user): array
    {
        return [
            $user->name,
            $user->email,
            strtoupper($user->role),
            $user->created_at->format('d M Y')
        ];
    }

    public function headings(): array
    {
        return ['Nama Lengkap', 'Email', 'Role / Hak Akses', 'Tanggal Terdaftar'];
    }
}

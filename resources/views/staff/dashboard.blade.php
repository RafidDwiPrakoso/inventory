@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="mb-4">
    <h4 class="fw-bold">Selamat Datang, {{ auth()->user()->name }}! 👋</h4>
</div>
@endsection

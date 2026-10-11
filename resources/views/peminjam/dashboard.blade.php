@extends('layout.persona')

@section('title', 'Dashboard Peminjam')

@section('content')

<h1>Dashboard Peminjam</h1>

<p>Selamat datang, {{ auth()->user()->name }}</p>

<a href="{{ url('/barang') }}">Barang</a>
<a href="{{ url('/kembalikan') }}">Kembalikan</a>

<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Logout</button>
</form>

@endsection
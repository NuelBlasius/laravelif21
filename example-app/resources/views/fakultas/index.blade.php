@extends('layout.main')

@section('title', 'Daftar Fakultas')

@section('content')
    <h2>Daftar Fakultas</h2>
    <p>ini halaman daftar fakultas</p>

    @foreach ($fakultas as $item)
        {{ $item['nama'] }} {{ $item['singkatan'] }} <br>
    @endforeach
@endsection

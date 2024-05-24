@extends('layout.main')
@section('title', 'Daftar Mahasiswa')
@section('content')

<div class="row">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Daftar Mahasiswa</h4>
        <p class="card-description">
          List Data Mahasiswa
        </p>
        <a href="{{ url('mahasiswa/create') }}" class="btn btn-success btn-rounded btn-fw">Tambah Fakultas</a>
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>NPM</th>
                <th>Nama Mahasiswa</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahit</th>
                <th>Alamat</th>
                <th>Kota</th>
                <th>Program Studi</th>
                <th>Foto</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($mahasiswa as $item)
        <tr>
          <td>{{  $item['npm'] }} </td>
          <td>{{ $item['nama'] }}</td>
          <td>{{  $item['prodi'] ['program_studi'] }} </td>
          <td>{{ $item['kota'] ['nama_kota'] }}</td>
        </tr>

      @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if (session('success'))

  <script>
  Swal.fire({
    title: "Good Job!",
    text: "{{ session('success') }}",
    icon: "success"
  });
  </script>
@endif
@endsection
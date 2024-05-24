<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Models\Kota;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mahasiswa = Mahasiswa::all(); // select * from fakultas
        return view('mahasiswa.index')->with('mahasiswa', $mahasiswa);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $prodi = Prodi::all();
        $kota = Kota::all(); // select * from fakultas
        return view('mahasiswa.create')
            ->with('prodi', $prodi)
            ->with('kota', $kota);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $val = $request->validate([
            'npm' => 'required|unique:mahasiswa',
            'nama' => 'required|unique:mahasiswa',
            'tempat_lahir' => 'required|unique:mahasiswa',
            'tanggal_lahir' => 'required|unique:mahasiswa',
            'alamat' => 'required|unique:mahasiswa',
            'kota_id' => 'required',
            'prodi_id' => 'required',
            'url_foto' => 'required|unique:mahasiswa'
        ]);

        Mahasiswa::create($val);
        return redirect()->route('mahasiswa.index')->with('success', $val['nama'] . ' berhasil disimpan ');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        //
    }
}
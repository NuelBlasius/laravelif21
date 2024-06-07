<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Models\Kota;
use Illuminate\Support\Facades\File;
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
        // dd($request);
        $val = $request->validate([
            'npm' => 'required|unique:mahasiswas',
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'kota_id' => 'required',
            'prodi_id' => 'required',
            'url_foto' => 'required|file|mimes:png,jpg|max:5000'
        ]);

        $ext = $request->url_foto->getClientOriginalExtension(); // png / jgp
        $val['url_foto'] = $request->npm. "." .$ext;

        // upload bisa pakai move() atau storeAs()
        $request->url_foto->move('foto', $val['url_foto']);

        Mahasiswa::create($val);
        return redirect()->route('mahasiswa.index')->with('success', $val['nama'] . ' berhasil disimpan ');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mahasiswa $mahasiswa)
    {
        // dd($mahasiswa);
        return view('mahasiswa.show')->with('mahasiswa', $mahasiswa);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        // dd($mahasiswa);
        $prodi = Prodi::all();
        $kota = Kota::all(); // select * from fakultas
        return view('mahasiswa.edit')
            ->with('prodi', $prodi)
            ->with('kota', $kota)
            ->with('mahasiswa', $mahasiswa);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        if ($request->hasFile('url_foto')) {
            // hapus file foto lama
            File::delete('foto/' . $mahasiswa['url_foto']);
            // validasi data input
            $val = $request->validate([
                'npm' => 'required',
                'nama' => 'required',
                'tempat_lahir' => 'required',
                'tanggal_lahir' => 'required',
                'alamat' => 'required',
                'kota_id' => 'required',
                'prodi_id' => 'required',
                'url_foto' => 'required|file|mimes:png,jpg|max:5000'
            ]);

            $ext = $request->url_foto->getClientOriginalExtension(); // png / jgp
            $val['url_foto'] = $request->npm. "." .$ext;
            // upload bisa pakai move() atau storeAs()
            $request->url_foto->move('foto', $val['url_foto']);
        } else {
            $val = $request->validate([
                'npm' => 'required',
                'nama' => 'required',
                'tempat_lahir' => 'required',
                'tanggal_lahir' => 'required',
                'alamat' => 'required',
                'kota_id' => 'required',
                'prodi_id' => 'required',
                'url_foto' => 'required|file|mimes:png,jpg|max:5000'
            ]);
        }
        
        $mahasiswa->update($val);
        return redirect()->route('mahasiswa.index')->with('success', $val['nama'] . ' berhasil disimpan ');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        File::delete('foto/' . $mahasiswa['url_foto']);
        $mahasiswa->delete();
        return redirect()->route('mahasiswa.index')->with('success', 'Data Berhasil Dihapus');
    }
}

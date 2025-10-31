<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('IndexMahasiswa', ['mahasiswas' => Mahasiswa::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('createMahasiswa', ['mahasiswa' => null]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = Mahasiswa::create([
            'name' => $request->name,
            'NIM' => $request->NIM,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jurusan' => $request->jurusan,
            'angkatan' => $request->angkatan
        ]);

        return redirect()->route('mahasiswa.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $mahasiswa = Mahasiswa::find($id);
        return view('createMahasiswa', ['mahasiswa' => $mahasiswa]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::find($id);
        $mahasiswa->name = $request->name;
        $mahasiswa->nim = $request->NIM;
        $mahasiswa->tempat_lahir = $request->tempat_lahir;
        $mahasiswa->tanggal_lahir = $request->tanggal_lahir;
        $mahasiswa->jurusan = $request->jurusan;
        $mahasiswa->angkatan = $request->angkatan;

        $mahasiswa->save();

        return redirect()->route('mahasiswa.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $mahasiswa = Mahasiswa::find($id);
        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index');
    }
}

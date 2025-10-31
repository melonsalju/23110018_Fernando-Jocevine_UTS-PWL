<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Matakuliah;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($matkul_id = null)
    {
        if ($matkul_id != null) {
            return view('absensi', [
                'mahasiswas' => Mahasiswa::with(['absensi' => function ($q) use ($matkul_id) {
                    $q->where('matakuliah_id', $matkul_id);
                }])->get(),
                'matkuls' => Matakuliah::all(),
            ]);
        }
        return view('absensi', [
            'mahasiswas' => Mahasiswa::all(),
            'matkuls' => Matakuliah::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $mahasiswas = Mahasiswa::all();
        foreach ($mahasiswas as $index => $mahasiswa) {
            if ($request->status_absen != null) {
                Absensi::create([
                    'mahasiswa_id' => $mahasiswa->id,
                    'matakuliah_id' => $request->matakuliah_id,
                    'tanggal_absensi' => $request->tanggal_absensi,
                    'status_absen' => $request->status_absen[$index]
                ]);
            }
        }

        return redirect()->route('absensi.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

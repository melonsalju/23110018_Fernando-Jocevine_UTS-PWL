<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;
use Illuminate\Http\Request;

class MatkulController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $matkul = Matakuliah::all();
        return view('IndexMatkul', ['matkuls' => $matkul]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('createMatkul', ['matkul' => null]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Matakuliah::create([
            'nama_matakuliah' => $request->nama_matakuliah,
            'kode' => $request->kode,
        ]);

        return redirect()->route('matkul.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $matkul = Matakuliah::find($id);
        return view('createMatkul', ['matkul' => $matkul]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, Request $request)
    {
        $matkul = Matakuliah::find($id);
        $matkul->nama_matakuliah = $request->nama_matakuliah;
        $matkul->kode = $request->kode;
        $matkul->save();

        return redirect()->route('matkul.index');
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
    public function delete(string $id)
    {
        $matkul = Matakuliah::find($id);
        $matkul->delete();

        return redirect()->route('matkul.index');
    }
}

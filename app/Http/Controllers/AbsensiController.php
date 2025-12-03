<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Matakuliah;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $data = Mahasiswa::where('jurusan', $request->jurusan)->with(['absensi' => function ($q) use ($request) {
        //     $q->where('matakuliah_id', $request->matkul_id)
        //         ->where('tanggal_absensi', $request->tanggal_absensi);
        // }])->get();

        // return $data;

        if ($request->ajax()) {
            $data = Mahasiswa::where('jurusan', $request->jurusan)->with(['absensi' => function ($q) use ($request) {
                $q->where('matakuliah_id', $request->matkul_id)
                    ->where('tanggal_absensi', $request->tanggal_absensi);
            }])->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('id_mahasiswa', function ($row) {
                    return $row->id;
                })
                ->addColumn('absensi', function ($row) use ($request) {
                    if ($row->absensi && count($row->absensi) > 0) {

                        $status = $row->absensi[count($row->absensi) - 1]->status_absen;

                        return match ($status) {
                            'H' => '<span class="badge bg-success">Hadir</span>',
                            'S' => '<span class="badge bg-warning text-dark">Sakit</span>',
                            'I' => '<span class="badge bg-info text-dark">Izin</span>',
                            'A' => '<span class="badge bg-danger">Alfa</span>',
                            default => ''
                        };
                    }
                    return '';
                })
                ->addColumn('status_absen', function ($row) {
                    if ($row->absensi && count($row->absensi) > 0) {
                        return '
                    <input type="radio" name="status_absen[' . $row->id . ']" value="H" '
                            . ($row->absensi[count($row->absensi) - 1]->status_absen === "H" ? "checked" : "") .
                            ' > <label>H</label>
                    <input type="radio" name="status_absen[' . $row->id . ']" value="A" '
                            . ($row->absensi[count($row->absensi) - 1]->status_absen === "A" ? "checked" : "") .
                            ' > <label>A</label>
                    <input type="radio" name="status_absen[' . $row->id . ']" value="I" '
                            . ($row->absensi[count($row->absensi) - 1]->status_absen === "I" ? "checked" : "") .
                            ' > <label>I</label>
                    <input type="radio" name="status_absen[' . $row->id . ']" value="S" '
                            . ($row->absensi[count($row->absensi) - 1]->status_absen === "S" ? "checked" : "") .
                            ' > <label>S</label>';
                    }

                    return '
                    <input type="radio" name="status_absen[' . $row->id . ']" value="H"> <label>H</label>
                    <input type="radio" name="status_absen[' . $row->id . ']" value="A"> <label>A</label>
                    <input type="radio" name="status_absen[' . $row->id . ']" value="I"> <label>I</label>
                    <input type="radio" name="status_absen[' . $row->id . ']" value="S"> <label>S</label>';
                })
                ->rawColumns(['id_mahasiswa', 'absensi', 'status_absen'])
                ->make(true);
        }

        return view('absensi', [
            'mahasiswas' => Mahasiswa::all(),
            'matkuls' => Matakuliah::all(),
            'jurusans' => ['Sistem dan Teknologi Informasi', 'Bisnis Digital', 'Kewirausahaan']
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
        if ($request->ajax()) {
            $mahasiswas = Mahasiswa::where('jurusan', $request->jurusan)->get();
            foreach ($mahasiswas as $index => $mahasiswa) {
                if ($request->status_absen != null) {
                    $key = array_keys($request->status_absen)[$index];
                    Absensi::create([
                        'mahasiswa_id' => $key,
                        'matakuliah_id' => $request->matakuliah_id,
                        'tanggal_absensi' => $request->tanggal_absensi,
                        'status_absen' => $request->status_absen[$key],
                    ]);
                }
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
     * Update the specified resffource in storage.
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

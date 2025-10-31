<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi</title>
    @vite(['resources/saas/app.scss', 'resources/js/app.js'])

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
</head>

<body>
    <form action="{{ route('absensi.store') }}" method="POST">
        @csrf
        <label for="">Mata Kuliah :</label>
        <select name="matakuliah_id" id="matkul">
            <option value="" selected>--Pilih Matakuliah</option>
            @foreach ($matkuls as $matkul)
            <option value="{{ $matkul->id }}">{{ $matkul->nama_matakuliah }}</option>
            @endforeach
        </select>

        <label for="">Tanggal Absensi :</label>
        <input type="date" name="tanggal_absensi" id="">

        <button type="submit">Simpan Absensi</button>

        <table class="table table-striped">
            <thead>
                <tr>
                    <td>No</td>
                    <td>Mahasiswa</td>
                    <td>Kehadiran</td>
                    <td>Status</td>
                </tr>
            </thead>

            <tbody>
                @foreach ($mahasiswas as $mahasiswa)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        {{ $mahasiswa->name }}
                    </td>
                    <td>@if(count($mahasiswa->absensi) > 0)
                        @if ($mahasiswa->absensi[$loop->iteration - 1]->status_absen == 'H')
                        <span class="badge bg-success">Hadir</span>
                        @elseif ($mahasiswa->absensi[$loop->iteration - 1]->status_absen == 'S')
                        <span class="badge bg-warning text-dark">Sakit</span>
                        @elseif ($mahasiswa->absensi[$loop->iteration - 1]->status_absen == 'I')
                        <span class="badge bg-info text-dark">Izin</span>
                        @elseif ($mahasiswa->absensi[$loop->iteration - 1]->status_absen == 'A')
                        <span class="badge bg-danger">Alfa</span>
                        @else
                        @endif
                        @endif
                    </td>
                    <td>
                        <input type="radio" name="status_absen[]" value="H" id="">
                        <label for="">H</label>
                        <input type="radio" name="status_absen[]" value="A" id="">
                        <label for="">A</label>
                        <input type="radio" name="status_absen[]" value="I" id="">
                        <label for="">I</label>
                        <input type="radio" name="status_absen[]" value="S" id="">
                        <label for="">S</label>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </form>
</body>

</html>
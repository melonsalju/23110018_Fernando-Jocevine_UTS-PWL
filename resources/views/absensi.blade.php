<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi</title>
    @vite(['resources/saas/app.scss', 'resources/js/app.js', 'resources/css/app.css'])

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>

<script type="text/javascript">
    $(document).ready(function () {
        $('select').select2();
        const matkul = $('#matkul');
        const tanggal_absensi = $('#tanggal_absensi');
        const jurusan = $('#jurusan');

        let table = $('#table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('absensi.index') }}",
                type: 'GET',
                data: function(d) {
                    d.tanggal_absensi = tanggal_absensi.val();
                    d.matkul_id = matkul.val();
                    d.jurusan = jurusan.val();
                }
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'name', name: 'name' },
                {
                    data: 'id_mahasiswa',
                    name: 'id_mahasiswa',
                    className: 'hidden',
                    render: function (data) {
                    return `<input type="hidden" name="id_mahasiswa[]" value="${data}" />`;
                    }
                },
                {
                    data: 'absensi', name: 'absensi',
                },
                {
                    data: 'status_absen', name: 'status_absen',
                }
            ]
        });

        $('#matkul, #tanggal_absensi, #jurusan').on('change', function () {
            table.ajax.reload();
        })

        $("#form").submit(function (e) {
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: "{{ route('absensi.store') }}",
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function (response) {
                    table.ajax.reload();
                }
            });
        });
    });
</script>

<body>
    <form id="form" method="POST" class="pl-[18px] pr-[18px] pt-3 pb-3 flex flex-col gap-4">
        @csrf
        <div class="flex items-center gap-x-4">
            <label for="">Jurusan : </label>
            <select name="jurusan" id="jurusan">
                <option value="">--Pilih Jurusan--</option>
                @foreach ($jurusans as $jurusan)
                <option value="{{ $jurusan }}">{{ $jurusan }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex gap-4 items-center">
            <div class="flex items-center gap-x-4">
                <label for="">Mata Kuliah :</label>
                <select name="matakuliah_id" id="matkul" class="w-full">
                    <option value="" selected>--Pilih Matakuliah--</option>
                    @foreach ($matkuls as $matkul)
                    <option value="{{ $matkul->id }}">{{ $matkul->nama_matakuliah }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-center gap-x-4">
                <label for="">Tanggal Absensi :</label>
                <input type="date" name="tanggal_absensi" id="tanggal_absensi"
                    class="border border-slate-300 pl-4 pr-4 pt-1 pb-1">
            </div>

            <button type="submit"
                class="!rounded-2xl bg-blue-200 p-2 !pr-4 !pl-4 font-bold hover:shadow transition-all ease-in-out duration-300">Simpan
                Absensi</button>
        </div>

        <table class="table table-striped" id="table">
            <thead>
                <tr>
                    <td>No</td>
                    <td>Mahasiswa</td>
                    <td>id</td>
                    <td>Kehadiran</td>
                    <td>Status</td>
                </tr>
            </thead>
        </table>
    </form>
</body>

</html>

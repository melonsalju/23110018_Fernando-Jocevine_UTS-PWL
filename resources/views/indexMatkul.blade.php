<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/saas/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div>
        <br>
        <table class="table table-striped table-striped-columns">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Kode</th>
                    <th scope="col">Nama Matakuliah</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($matkuls as $matkul)
                <tr>
                    <td scope="row">{{$matkul['id']}}</td>
                    <td>{{$matkul['nama_matakuliah']}}</td>
                    <td>{{$matkul['kode']}}</td>
                    <td>
                        <a href="{{ route('matkul.show', $matkul['id']) }}">Edit</a>
                        <a href="{{ route('matkul.delete', $matkul['id']) }}">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <br>
        <table border=1 style="background-color: black;">
            <tr>
                <th style="color: white;">ID</th>
                <th style="color: white;">NIM</th>

            </tr>

            <tr>

            </tr>

        </table>
    </div>
</body>

</html>
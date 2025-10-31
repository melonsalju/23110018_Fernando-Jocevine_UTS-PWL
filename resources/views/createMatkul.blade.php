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
        <form method="post" action="@if(isset($matkul))
            {{ route('matkul.update', ['id' => $matkul['id']]) }}
        @else
            {{ route('matkul.store') }}
        @endif">
            @csrf
            @if(isset($matkul))
            <input type="hidden" name="_method" value="put" />
            @endif

            <table border="1" bgcolor="black">
                <tr>
                    <td colspan=6 align="center">
                        <h1>
                            <font color="white">
                                @if(isset($matkul))
                                Update Matakuliah
                                @else
                                Create Matakuliah
                                @endif</font>
                        </h1>
                    </td>
                </tr>
                <tr>
                    <td>
                        <font color="white">Nama Matakuliah</font>
                    </td>
                    <td colspan=5><input type="text" name="nama_matakuliah" size="55"
                            value="{{ $matkul['nama_matakuliah'] ?? ''}}"></td>
                </tr>
                <tr>
                    <td>
                        <font color="white">Kode</font>
                    </td>
                    <td colspan=5><input type="text" name="kode" size="55" value="{{ $matkul['kode'] ?? ''}}"></td>
                </tr>

                <tr>
                    <td colspan="3" align="center"><input type="submit" value="Create"></td>
                    <td colspan="3" align="center"><input type="reset" value="Batal"></td>
                </tr>
            </table>
        </form>
    </div>
</body>

</html>
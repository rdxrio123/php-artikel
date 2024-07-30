@extends('template')
@section('konten')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <center><h3>Data Berita</h3></center>
    <a href="tambahArtikel" class="btn btn-primary">Tambah</a>
    <table border="1" class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Image</th>
                <th>Title</th>         
                <th colspan="3">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1 @endphp
            @foreach ($data as $isi)
            <tr>
                <td>{{ $no++ }}</td>
                <td>
                    @if ($isi->image)
                  
                    <img src="{{asset('images/' . $isi->image) }}" alt="image" width="100">
                          
                    @else
                        Tidak ada Gambar
                    @endif
                </td>
                <td class="wrap-text"><b><span>{{ $isi->title }}</span></b></td>

                <td><a href="{{ url('editArtikel/' . $isi->id) }}"><i class="fas fa-edit"></i></a></td>
                <td><a href="{{ url('hapusArtikel/' . $isi->id) }}"><i class="fas fa-trash-alt" style="color:red;"></i></a></td>
                <td><a href="{{ url('detailArtikel/' . $isi->id) }}"><i class="fas fa-info"></i></a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
</body>
</html>
@extends('template')

@section('konten')
<div class="container mt-9">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="text-center">Detail Berita</h1>
            <div class="card">
                <div class="card-body">
                    <div class="form-group text-center">
                        <label for="image"></label>
                        @if ($data->image)
                            <img src="{{ asset('images/' . $data->image) }}" alt="Image" class="img-fluid" style="max-width: 500px;">
                        @else
                            <p>Tidak ada gambar</p>
                        @endif
                    </div>

                    <div class="form-group text-left">
                        <label for="tanggal">Tanggal:</label>
                        <p>{{ $data->tanggal }}</p>
                    </div>

                    <div class="form-group text-left">
                        <label for="penulis">Penulis:</label>
                        <p>{{ $data->penulis }}</p>
                    </div>

                    <div class="form-group text-left">
                        <label for="title">Title:</label>
                        <p>{{ $data->title }}</p>
                    </div>

                    <div class="form-group text-left">
                        <label for="content">Content:</label>
                        <p>{{ $data->content }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

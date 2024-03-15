@extends('adminlte::page') 
@section('title', 'Edit Kategori Berita') 
@section('content_header') 
    <h1 class="m-0 text-dark">Edit Kategori Berita</h1>
@stop
@section('content') 
    <form action="{{route('katber.update', $kategori_berita)}}" method="post">
        @method('PUT') 
        @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="kategori_berita">Kategori Berita</label>
                        <input type="text" class="form-control 
@error('kategori_berita') is-invalid @enderror" id="kategori_berita"
placeholder="Kategori Berita" name="kategori_berita" 
value="{{$kategori_berita->kategori_berita ?? old('kategori_berita')}}">
                        @error('kategori_berita') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{route('katber.index')}}" class="btn 
btn-default">
                        Batal
                    </a>
                </div>
            </div>
        </div>
    </div>
@stop
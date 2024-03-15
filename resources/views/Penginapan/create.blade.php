@extends('adminlte::page') 
@section('title', 'Tambah Penginapan') 
@section('content_header') 
    <h1 class="m-0 text-dark">Tambah Penginapan</h1>
@stop
@section('content') 
    <form action="{{route('penginapan.store')}}" method="post" enctype="multipart/form-data">
        @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="nama_penginapan">Nama Penginapan</label>
                        <input type="text" class="form-control 
@error('nama_penginapan') is-invalid @enderror" id="nama_penginapan" placeholder="nama_penginapan" name="nama_penginapan"
                            value="{{old('nama_penginapan')}}">
                        @error('nama_penginapan') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea type="text" class="form-control" name="deskripsi">{{old('deskripsi')}}</textarea>
                        @error('deskripsi') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="fasilitas">Fasilitas</label>
                        <input type="text" class="form-control @error('fasilitas') is-invalid @enderror" id="fasilitas" placeholder="Fasilitas" name="fasilitas" 
                        value="{{old('fasilitas')}}">
                        @error('fasilitas') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="foto1" class="form-label">Foto1</label>
                        <img src="/img/no-image.png" class="img-thumbnail d-block" name="tampil1" alt="..." width="10%" id="tampil1">
                        <input class="form-control @error('foto1') is-invalid @enderror" type="file" id="foto1" name="foto1">
                        @error('foto1') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="foto2" class="form-label">Foto2</label>
                        <img src="/img/no-image.png" class="img-thumbnail d-block" name="tampil2" alt="..." width="10%" id="tampil2">
                        <input class="form-control @error('foto2') is-invalid @enderror" type="file" id="foto2" name="foto2">
                        @error('foto2') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="foto3" class="form-label">Foto3</label>
                        <img src="/img/no-image.png" class="img-thumbnail d-block" name="tampil3" alt="..." width="10%" id="tampil3">
                        <input class="form-control @error('foto3') is-invalid @enderror" type="file" id="foto3" name="foto3">
                        @error('foto3') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="foto4" class="form-label">Foto4</label>
                        <img src="/img/no-image.png" class="img-thumbnail d-block" name="tampil4" alt="..." width="10%" id="tampil4">
                        <input class="form-control @error('foto4') is-invalid @enderror" type="file" id="foto4" name="foto4">
                        @error('foto4') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="foto5" class="form-label">Foto5</label>
                        <img src="/img/no-image.png" class="img-thumbnail d-block" name="tampil5" alt="..." width="10%" id="tampil5">
                        <input class="form-control @error('foto5') is-invalid @enderror" type="file" id="foto5" name="foto5">
                        @error('foto5') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{route('penginapan.index')}}" class="btn btn-default">
                        Batal
                    </a>
                </div>
            </div>
        </div>
    </div>
@stop
@push('js') 
    <script> 
        $('#example2').DataTable({
            "responsive": true, 
        });

        function readURL1(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#tampil1').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#foto1").change(function () {
            readURL1(this);
        });

        function readURL2(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#tampil2').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#foto2").change(function () {
            readURL2(this);
        });

        function readURL3(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#tampil3').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#foto3").change(function () {
            readURL3(this);
        });

        function readURL4(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#tampil4').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#foto4").change(function () {
            readURL4(this);
        });

        function readURL5(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#tampil5').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#foto5").change(function () {
            readURL5(this);
        });
    </script> 
@endpush
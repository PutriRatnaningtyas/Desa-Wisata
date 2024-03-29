@extends('adminlte::page') 
@section('title', 'Edit Berita') 
@section('content_header') 
    <h1 class="m-0 text-dark">Edit Berita</h1>
@stop
@section('content') 
    <form action="{{route('berita.update', $berita)}}" method="post" enctype="multipart/form-data">
        @method('PUT') 
        @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                    <label for="judul">Judul</label>
                        <input type="text" class="form-control 
@error('judul') is-invalid @enderror" id="judul" placeholder="Judul" name="judul"
                            value="{(($berita->judul ??old('judul')}}">
                        @error('judul') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="berita">Berita</label>
                        <textarea type="text" class="form-control" name="berita">{{$berita->berita ??old('berita')}}</textarea>
                        @error('berita') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="tgl_post">Tanggal Post</label>
                        <input type="datetime-local" class="form-control" 
                            class="form-control @error('tgl_post') is-invalid @enderror" id="tgl_post" 
                            placeholder="Tanggal Post" name="tgl_post" value="{{$berita->tgl_post ??old('tgl_post')}}">
                        @error('tgl_post') <span class="textdanger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="id_kategori_berita">Kategori Berita</label>
                        <div class="input-group">
                            <input type="hidden" name="id_kategori_berita" id="id_kategori_berita" value="{{old('id_kategori_berita')}}">
                            <input type="text" class="form-control 
@error('kategori_berita') is-invalid @enderror" placeholder="Kategori Berita"
id="kategori_berita" name="kategori_berita" value="{{$berita->kategori_berita ??old('kategori_berita')}}" aria-label="Kategori Berita" aria-describedby="cari" readonly>
                            <button class="btn btn-warning" type="button" data-bs-toggle="modal" id="cari" data-bs-target="#staticBackdrop"></i>
                            Cari Data Kategori Berita</button>
                        </div>
                        <div class="form-group">
                        <label for="foto" class="form-label">Foto</label>
                        <img src="/img/no-image.png" class="img-thumbnail d-block" name="tampil" alt="..." width="15%" id="tampil">
                        <input class="form-control @error('foto') is-invalid @enderror" type="file" id="foto" name="foto">
                        @error('foto') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                    </div> 
                    <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{route('berita.index')}}" class="btn btn-default">
                        Batal
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable p-5">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5"
id="staticBackdropLabel">Pencarian Data Kategori Berita</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-hover table-bordered table-stripped" id="example2">
                            <thead>
                            <tr>
                            <th>No.</th>
                            <th>Kategori Berita</th>
                            <th>Opsi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($katber as $key => $kb)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$kb->kategori_berita}}</td>
                                <td>
                                        <button type="button" class="btn btn-primary 
btn-xs" onclick="pilih('{{$kb->id}}', '{{$kb->kategori_berita}}')" data-bs-dismiss="modal">
                                            Pilih
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> 
                <!-- End Modal -->
@stop
@push('js') 
    <script> 
        $('#example2').DataTable({
            "responsive": true, 
        });

        function pilih(id, kategori_berita){
            document.getElementById('id_kategori_berita').value = id
            document.getElementById('kategori_berita').value = kategori_berita
        } 

        function readURL1(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#tampil').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#foto").change(function () {
            readURL1(this);
        });
    </script> 
@endpush
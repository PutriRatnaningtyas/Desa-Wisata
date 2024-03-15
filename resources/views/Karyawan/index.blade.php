@extends('adminlte::page') 
@section('title', 'List Karyawan') 
@section('content_header') 
    <h1 class="m-0 text-dark">List Karyawan</h1>
@stop
@section('content') 
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{route('karyawan.create')}}" class="btn 
btn-primary mb-2">
                        Tambah
                    </a>
                    <table class="table table-hover table-bordered 
table-stripped" id="example2">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Id Karyawan</th>
                            <th>Nama Karyawan</th>
                            <th>Alamat</th>
                            <th>Nomor Telepon</th>
                            <th>Jabatan</th>
                            <th>Id User</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($karyawan as $key => $kr)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$kr->id}}</td>
                            <td id={{$key+1}}>{{$kr->nama_karyawan}}</td>
                            <td id={{$key+1}}>{{$kr->alamat}}</td>
                            <td id={{$key+1}}>{{$kr->no_hp}}</td>
                            <td id={{$key+1}}>{{$kr->jabatan}}</td>
                            <td id={{$key+1}}>{{$kr->users->email}}</td>
                            <td>
                                <a href="{{route('karyawan.edit', $kr)}}" class="btn btn-primary btn-xs">
                                    Edit
                                </a>
                                <a href="{{route('karyawan.destroy', $kr)}}"
                                    onclick="notificationBeforeDelete(event, this, <?php echo $key+1; ?>)"
                                    class="btn btn-danger btn-xs">
                                    Delete
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
@push('js') 
    <form action="" id="delete-form" method="post">
        @method('delete') 
        @csrf
    </form>
    <script> 
        $('#example2').DataTable({
            "responsive": true, 
        });
        function notificationBeforeDelete(event, el, dt) {
            event.preventDefault();
            if (confirm('Apakah anda yakin akan menghapus data karyawan? \"' + document.getElementById(dt).innerHTML + '\" ?')) {
                $("#delete-form").attr('action', $(el).attr('href'));
                $("#delete-form").submit();
            } 
        }
    </script> 
@endpush
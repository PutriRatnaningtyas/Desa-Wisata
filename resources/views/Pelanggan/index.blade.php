@extends('adminlte::page') 
@section('title', 'List Pelanggan') 
@section('content_header') 
    <h1 class="m-0 text-dark">List Pelanggan</h1>
@stop
@section('content') 
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{route('pelanggan.create')}}" class="btn 
btn-primary mb-2">
                        Tambah
                    </a>
                    <table class="table table-hover table-bordered 
table-stripped" id="example2">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Id Pelanggan</th>
                            <th>Nama Lengkap</th>
                            <th>Nomer Telepon</th>
                            <th>Alamat</th>
                            <th>Foto</th>
                            <th>Id User</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pelanggan as $key => $pl)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$pl->id}}</td>
                            <td id={{$key+1}}>{{$pl->nama_lengkap}}</td>
                            <td id={{$key+1}}>{{$pl->no_hp}}</td>
                            <td id={{$key+1}}>{{$pl->alamat}}</td>
                            <td>
                                <img src="storage/{{$pl->foto}}" alt="{{$pl->foto}} tidak tampil"
                                    class="img-thumbnail">
                            </td>
                            <td id={{$key+1}}>{{$pl->users->email}}</td>
                            
                            <td>
                                <a href="{{route('pelanggan.edit', $pl)}}" class="btn btn-primary btn-xs">
                                    Edit
                                </a>
                                <a href="{{route('pelanggan.destroy', $pl)}}"
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
            if (confirm('Apakah anda yakin akan menghapus data pelanggan? \"' + document.getElementById(dt).innerHTML + '\" ?')) {
                $("#delete-form").attr('action', $(el).attr('href'));
                $("#delete-form").submit();
            } 
        }
    </script> 
@endpush
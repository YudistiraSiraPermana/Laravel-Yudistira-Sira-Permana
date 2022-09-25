@extends('layouts.default')

@section('content')
    
    <section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Mahasiswa</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <a href="{{url('create')}}" class="btn btn-primary">+ Tambah Mahasiswa</a>
            </ol>
        </div>
        </div>
    </div>
    </section>
    <section>
        <div class="container">
            <div class="row">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-left">
                                <a href="{{url('exportmhs')}}" class="btn btn-primary" style="background-color:#008000; border-color:aliceblue">Export Excel</a>
                            </ol>
                        </div>
                                           
                    </div>
                    
                    
                    
                            <!-- /.card-header -->
                            <div class="card-body">
                              <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>NIM</th>
                                    <th>Foto</th>
                                    <th>Alamat</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataMhs as $d)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $d->nama }}</td>
                                            <td>{{ $d->NIM }}</td>
                                            <td>
                                                @if($d->foto)
                                                <img src="{{ asset('storage/'.$d->foto) }}" class="img-thumbnail" style="width:10%">
                                                @else
                                                <span class="badge badge-danger">No Foto</span>
                                                @endif
                                            </td>
                                            <td>{{ $d->alamat }}</td>
                                            <td>
                                                <button type="button" onclick="window.location='/edit/{{ $d->id }}'" style="background-color:#FFA500; border-color:aliceblue" class="btn btn-primary">
                                                    Edit
                                                </button>
                                                <form action="/destroy/{{ $d->id }}" method="POST" enctype="multipart/form-data" style="display: inline" onsubmit="return hapusData()">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" style="background-color:#FF0000; border-color:aliceblue" class="btn btn-primary" >
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>NIM</th>
                                    <th>Foto</th>
                                    <th>Alamat</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                              </table>
                            </div>            

                    
                    
                    
                    <!-- /.card-body -->
                    <div class="card-footer">
                    
                    </div>
                    <!-- /.card-footer-->
                </div>
               
                
            </div>
            
        </div>
        <script>
            function hapusData(){
                pesan = confirm('Yakin data dini dihapus?');
                if (pesan)
                    return true;
                else return false;
            }
        </script>
    </section>

    
@endsection
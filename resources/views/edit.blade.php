@extends('layouts.default')

@section('content')
<div class="col-sm-6 mt-3">
    <h1>Edit Mahasiswa</h1>
</div>
    <div class="card-header">
                            
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
                <a href="{{url('/')}}" class="btn btn-primary" style="background-color:#FFA500; border-color:aliceblue">< Back</a>
            </ol>
        </div>
                        
    </div>
    <div class="card card-primary mt-3">
        
        <script>
            var msg = '{{Session::get('alert')}}';
            var exist = '{{Session::has('alert')}}';
            if(exist){
              alert(msg);
            }
          </script>
        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
          @endif
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ url('/update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="id">ID</label>
                    <input type="number" name="id" class="form-control" value="{{ $id }}" readonly style="cursor: not-allowed">
                </div>
                <div class="form-group">
                <label for="nama">Nama Mahasiswa</label>
                <input type="text" name="nama" class="form-control
                @error('nama')
                    is-invalid
                @enderror" value="{{ $nama }}">
                </div>
                <div class="form-group">
                    <label for="NIM">NIM</label>
                    <input type="number" name="NIM" class="form-control
                    @error('NIM')
                    is-invalid
                @enderror" value="{{ $NIM }}">
                </div>
                <div class="form-group">
                    <label for="foto">Foto</label>
                    <br>
                    @if($foto)
                        <img src="{{ asset('storage/'.$foto) }}" class="img-thumbnail" style="width:30%">
                    @else
                        <span class="badge badge-danger">No Foto</span>
                    @endif
                    <br>
                    <input type="file" name="foto" id="foto" class="form-control
                    @error('foto')
                    is-invalid
                @enderror" value="{{ $foto }}" accept="image/*">
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea class="form-control
                    @error('alamat')
                    is-invalid
                @enderror" name="alamat">{{ $alamat }}</textarea>
                </div>
                
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
   
@endsection
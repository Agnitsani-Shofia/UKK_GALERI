@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                <div>Gambar</div>
                <div>
                    <!-- <form class="form-inline">
                        <select class="form-control">
                            <option>Oldest</opstion>
                            <option>Latest</opstion>
                        </select>
                    </form> -->
                </div>
            </div>
        </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-3">
                            <div class="list-group">
                                <a href="#" class="list-group-item list-group-item-action">Hewan</a>
                                <a href="#" class="list-group-item list-group-item-action">Tumbuhan</a>
                                <a href="#" class="list-group-item list-group-item-action">Keluarga</a>
                            </div>
                        </div>
                    <div class="col-md-9">

                    <div class="row">
                    <div class="col-md-12">
                        @if($errors->any())
                        @foreach($errors->all() as $error)
                        
                        <div class="alert alert-danger">
                            <strong>Error!</strong> {{$error}}
                        </div>
                        @endforeach
                        @endif
                        <form action="{{route('update', $image->id)}}" method="post" id="image_upload_form">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                            <label for="caption">Keterangan</label>
                            <input type="text" name="caption" class="form-control" placeholder="Tambah Keterangan" id="caption" value="{{$image->caption}}">
                            </div>
                <div class="form-group">
                    <label for="sel1">Pilih Kategori</label>
                        <select name="category" class="form-control" id="category">
                            <option value="" selected disabled>Pilih Kategori</option>
                            <option value="Hewan" {{$image->category == "hewan" ? 'selected' : ''}}>Hewan</option>
                            <option value="Tumbuhan" {{$image->category == "tumbuhan" ? 'selected' : ''}}>Tumbuhan</option>
                            <option value="Buah" {{$image->category == "buah" ? 'selected' : ''}}>Buah</option>
                        </select>
                    </div>

                        <button type="submit" class="btn btn-primary">Kirim</button>
                        </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
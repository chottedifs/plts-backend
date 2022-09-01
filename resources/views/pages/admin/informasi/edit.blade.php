@extends('layouts.master')

@section('content')
<div class="content">
    <!-- Animated -->
    <div class="animated fadeIn">
        <!--  /Traffic -->
        <div class="clearfix"></div>
        <!-- Orders -->
        <div class="orders">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="box-title">{{ $judul }}</h4>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('master-informasi.update', $informasi->id) }}" enctype="multipart/form-data">
                                @method('put')
                                @csrf
                                <div class="row">
                                    <div class="mb-3 col-lg-12">
                                        <label for="title" class="form-label">Judul Informasi</label>
                                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" autofocus value="{{ old('title', $informasi->title)  }}">
                                        @error('title')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-lg-12">
                                        <label for="deskripsi" class=" form-label">Deskripsi</label>
                                        <textarea name="deskripsi" id="deskripsi" rows="9" placeholder="Deskripsi..." class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $informasi->deskripsi) }}</textarea>
                                        @error('deskripsi')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div>
                                    @if($informasi->gambar)
                                        <img src="{{ Storage::url($informasi->gambar) }}" class="img-preview img-fluid" width="500px">
                                        @endif
                                        <img class="img-preview img-fluid" width="500px">
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-lg-12">
                                        <label for="gambar" >Upload Gambar</label>
                                        <input type="file" id="gambar" name="gambar" class="form-control @error('gambar') is-invalid @enderror" onchange="previewImage()">
                                        @error('gambar')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div> <!-- /.card -->
                </div>  <!-- /.col-lg-8 -->
            </div>
        </div>
        <!-- /.orders -->
    <!-- /#add-category -->
    </div>
    <!-- .animated -->
</div>

<script>
    function previewImage(){
        const image = document.querySelector('#gambar');
        const imgPreview = document.querySelector('.img-preview');

        const blob = URL.createObjectURL(image.files[0]);
        imgPreview.src = blob;
    }
</script>

@endsection

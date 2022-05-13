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
                            <h4 class="box-title">{{ $title }}</h4>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{route('rate.store')}}">
                                @csrf
                                <div class="row">
                                    <div class="mb-3 col-lg-12">
                                        <label for="type" class="form-label">Tipe Kios</label>
                                        <input type="text" name="type" class="form-control @error('type') is-invalid @enderror" id="type" autofocus value="{{ old('type') }}">
                                        @error('type')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-lg-12">
                                        <label for="price" class="form-label">Tarif Dasar Kios</label>
                                        <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" id="price" value="{{ old("price") }}">
                                        @error('price')
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
@endsection

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
                            <form method="post" action="{{ route('outlet.store') }}">
                                @csrf
                                {{-- <div class="row">
                                    <div class="mb-3 col-lg-12">
                                        <label for="id_user" class="form-label">Nama Penyewa Kios</label>
                                        <select name="id_user" id="id_user" class="form-control">
                                            @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> --}}
                                <div class="row">
                                    <div class="mb-3 col-lg-12">
                                        <label for="name_kios" class="form-label">Nama Kios</label>
                                        <input type="text" name="name_kios" class="form-control @error('name_kios') is-invalid @enderror" id="name_kios" autofocus>
                                        @error('name_kios')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-lg-12">
                                        <label for="id_rate" class="form-label">Type Outlet</label>
                                        <select name="id_rate" id="id_rate" class="form-control">
                                            @foreach($rates as $rate)
                                            <option value="{{ $rate->id }}">{{ $rate->type }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-lg-12">
                                        <label for="luas_kios" class="form-label">Luas Kios</label>
                                        <input type="text" name="luas_kios" class="form-control @error('luas_kios') is-invalid @enderror" id="luas_kios" autofocus>
                                        @error('luas_kios')
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

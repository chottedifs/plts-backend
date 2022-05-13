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
                        @if (session()->has('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                        <div class="card-body">
                            <h4 class="box-title">{{ $title }}</h4>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('user-kios.store') }}">
                                @csrf
                                <div class="row">
                                    <div class="mb-3 col-lg-12">
                                        <label for="name" class="form-label">Nama User</label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" autofocus value="{{ old("name") }}">
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-lg-12">
                                        <label for="email" class="form-label">Alamat Email</label>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" autofocus value="{{ old("email") }}">
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-lg-12">
                                        <label for="phone_number" class="form-label">Nomor handphone</label>
                                        <input type="tel" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" autofocus value="{{ old("phone_number") }}">
                                        @error('phone_number')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- <div class="row">
                                    <div class="mb-3 col-lg-12">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old("email") }}">
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-lg-12">
                                        <label for="phone_number" class="form-label">No Handphone</label>
                                        <input type="text" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" value="{{ old("phone_number") }}">
                                        @error('phone_number')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-lg-12">
                                        <label for="id_outlet" class="form-label">Name Outlet, Type Outlet And Luas kios</label>
                                        <select name="id_outlet" id="id_outlet" class="form-control">
                                            @foreach($outlets as $outlet)
                                            @if(!$outlet->status_kios)
                                                @if(old("id_outlet") == $outlet->id)
                                                    <option value="{{ $outlet->id }}" selected>{{ $outlet->name_kios }} || {{ $outlet->rate->type }} || Luas {{ $outlet->luas_kios }}</option>
                                                @else
                                                    <option value="{{ $outlet->id }}">{{ $outlet->name_kios }} || {{ $outlet->rate->type }} || Luas {{ $outlet->luas_kios }}</option>
                                                @endif
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div> --}}
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

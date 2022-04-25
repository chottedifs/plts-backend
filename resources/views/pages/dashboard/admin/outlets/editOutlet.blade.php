@extends('layouts.master')

@section('content')
<div class="content">
    <!-- Animated -->
    <div class="animated fadeIn">
        <!--  /Traffic -->
        <div class="clearfix"></div>

        <!-- Contents -->
        <div class="orders">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="box-title">{{ $title }}</h4>
                        </div>
                        <div class="card-body">
                            <form method="post" action="/admin/dashboard/outlet/{{ $outlet->id }}">
                                @method('put')
                                @csrf
                                <div class="row">
                                    <div class="mb-3 col-lg-12">
                                        <label for="id_user" class="form-label">Nama penyewa Outlet</label>
                                        <select name="id_user" id="id_user" class="form-control">
                                            @foreach($users as $user)
                                                @if (old('id_user', $outlet->id_user) == $user->id)
                                                    <option value="{{ $user->id }}" selected>{{ $user->name }}</option>
                                                @else
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-lg-12">
                                        <label for="name_outlet" class="form-label">Nama Toko</label>
                                        <input type="text" name="name_outlet" class="form-control @error('name_outlet') is-invalid @enderror" id="name_outlet" value="{{ $outlet->name_outlet }}" autofocus>
                                        @error('name_outlet') 
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-lg-12">
                                        <label for="id_user" class="form-label">Type Outlet</label>
                                        <select name="id_rate" id="id_rate" class="form-control">
                                            @foreach($rates as $rate)
                                            @if (old('id_rate', $outlet->id_rate) == $rate->id)
                                                <option value="{{ $rate->id }}" selected>{{ $rate->type }} | Rp {{ $rate->price }} </option>
                                            @else
                                                <option value="{{ $rate->id }}">{{ $rate->type }} | Rp {{ $rate->price }}</option>
                                            @endif
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div> <!-- /.card -->
                </div>  <!-- /.col-lg-8 -->
            </div>
        </div>
        <!-- /.Contents -->

    <!-- /#add-category -->
    </div>
    <!-- .animated -->
</div>
@endsection

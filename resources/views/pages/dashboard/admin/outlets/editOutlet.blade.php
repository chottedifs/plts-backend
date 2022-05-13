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
                            <form method="post" action="{{ route('outlet.update', $kios->id) }}">
                                @method('put')
                                @csrf
                                <div class="row">
                                    <div class="mb-3 col-lg-12">
                                        <label for="user_id" class="form-label">Nama penyewa Outlet</label>
                                        <select name="user_id" id="user_id" class="form-control">
                                            <option value="" disabled selected hidden>{{ $kios->User->name }}</option>
                                            <option value="" disabled>-- Pilih Pengguna Kios --</option>
                                            @foreach($users as $user)
                                                @if ($user->is_active)
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-lg-12">
                                        <label for="name_kios" class="form-label mt-3">Nama Toko</label>
                                        <input type="text" name="name_kios" class="form-control @error('name_kios') is-invalid @enderror" id="name_kios" value="{{ $kios->name_kios }}">
                                        @error('name_kios')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-lg-12">
                                        <label for="type_rate_id" class="form-label mt-3">Type Outlet</label>
                                        <select name="type_rate_id" id="type_rate_id" class="form-control">
                                            <option value="" disabled selected hidden>{{ $kios->Typerate->type }}</option>
                                            <option value="" disabled>-- Pilih Type Kios --</option>
                                            @foreach($typerates as $typerate)
                                            @if (old('type_rate_id', $typerate->id) == $typerate->id)
                                                <option value="{{ $typerate->id }}">{{ $typerate->type }}</option>
                                            @else
                                                <option value="{{ $typerate->id }}">{{ $typerate->type }}</option>
                                            @endif
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-lg-12">
                                        <label for="luas_kios" class="form-label mt-3">Nama Toko</label>
                                        <input type="text" name="luas_kios" class="form-control @error('luas_kios') is-invalid @enderror" id="luas_kios" value="{{ $kios->luas_kios }}">
                                        @error('luas_kios')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Submit</button>
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

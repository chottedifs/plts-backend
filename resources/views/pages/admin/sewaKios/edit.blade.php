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
                            <form method="post" action="{{ route('sewa-kios.update', $sewaKios->id) }}">
                                @method('put')
                                @csrf
                                <div class="row">
                                    <div class="mb-3 col-lg-12">
                                        <label for="user_id" class="form-label"></label>
                                        <select name="user_id" id="user_id" class="form-control @error('user_id') is-invalid @enderror">
                                            <option value="" disabled selected hidden>{{ $sewaKios->User->nama_lengkap }}</option>
                                            <option value="" disabled>-- Pilih Penyewa --</option>
                                            @foreach($users as $user)
                                                @if ($user->status_user == true)
                                                    <option value="" disabled>Tidak ada user tersedia</option>
                                                @else
                                                    <option value="{{ $user->id }}">{{ $user->nama_lengkap }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('user_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-lg-12">
                                        <label for="luas_kios" class="form-label">Kios</label>
                                        <select name="relasi_kios_id" id="relasi_kios_id" class="form-control mb-3 @error('relasi_kios_id') is-invalid @enderror">
                                            @foreach ($relasiDataKios as $relasiKios)
                                                @if ($sewaKios->RelasiKios->Kios->id == $relasiDataKiosBerdasarkan->kios_id)
                                                    <option value="{{ $sewaKios->RelasiKios->Kios->id }}" selected>{{ $sewaKios->RelasiKios->Kios->nama_kios }}</option>
                                                @endif
                                                {{-- @if ($relasiKios->status_relasi_kios == 0)
                                                    <option value="{{ $relasiKios->id }}" >{{ $sewaKios->RelasiKios->Kios->nama_kios }}</option>
                                                @endif --}}
                                            @endforeach
                                        </select>
                                        @error('relasi_kios_id')
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
        <!-- /.orders -->
    <!-- /#add-category -->
    </div>
    <!-- .animated -->
</div>
@endsection

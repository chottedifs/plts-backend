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
                            <form method="post" action="{{ route('tagihan.store') }}">
                                @csrf
                                <div class="row">
                                    <div class="mb-3 col-lg-12">
                                        <label for="outlet_id" class="form-label">Nama Kios</label>
                                        <select name="outlet_id" id="outlet_id" class="form-control">
                                            <option value="">-- Pilih Kios tersedia --</option>
                                            @foreach($outlets as $outlet)
                                                @if ($outlet->status_kios)
                                                    <option value="{{ $outlet->id }}">{{ $outlet->name_kios }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-lg-12">
                                        <label for="nilai_kwh_awal" class="form-label">Nilai Kwh Awal</label>
                                        <input type="number" name="nilai_kwh_awal" class="form-control @error('nilai_kwh_awal') is-invalid @enderror" id="nilai_kwh_awal" value="{{ old("nilai_kwh_awal") }}">
                                        @error('nilai_kwh_awal')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-lg-12">
                                        <label for="nilai_kwh_akhir" class="form-label">Nilai Kwh Akhir</label>
                                        <input type="number" name="nilai_kwh_akhir" class="form-control @error('nilai_kwh_akhir') is-invalid @enderror" id="nilai_kwh_akhir" value="{{ old("nilai_kwh_akhir") }}">
                                        @error('nilai_kwh_akhir')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-lg-12">
                                        <label for="total_kwh" class="form-label">Total Kwh</label>
                                        <input type="number" name="total_kwh" class="form-control @error('total_kwh') is-invalid @enderror" id="total_kwh" value="{{ old("total_kwh") }}">
                                        @error('total_kwh')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-lg-12">
                                        <label for="tarif_kwh" class="form-label">Nama Kios</label>
                                        <select name="tarif_kwh" id="tarif_kwh" class="form-control">
                                            <option value="">-- Pilih Tarif Dasar Kwh --</option>
                                            @foreach($kwhs as $kwh)
                                                @if ($kwh->id)
                                                    <option value="{{ $kwh->price }}">{{ $kwh->kode_tarif }} | {{ $kwh->price }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-lg-12">
                                        <label for="periode" class="form-label">Periode Tagihan</label>
                                        <input type="date" name="periode" class="form-control @error('periode') is-invalid @enderror" id="periode" value="{{ old("periode") }}">
                                        @error('periode')
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

@extends('layouts.master')

@section('content')
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>{{ $title }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{route('admin-dashboard')}}">Dashboard</a></li>
                            <li class="active">{{ $title }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Content --}}
<div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('tagihan.create') }}" class="btn btn-primary">Tambah {{ $title }}</a>
                        {{-- <form action="{{ route('import.tagihan') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-4">
                                <div class="custom-file text-left">
                                    <input type="file" name="file" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div>
                            <button class="btn btn-primary">Import Users</button>
                        </form> --}}
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Kios</th>
                                    <th>Kwh Awal</th>
                                    <th>Kwh Akhir</th>
                                    <th>Pemakaian Kwh</th>
                                    <th>Jumlah Tagihan</th>
                                    <th>Periode</th>
                                    <th>Status Pembayaran</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tagihans as $tagihan)
                                    <tr>
                                        <td class="serial">{{ $loop->iteration }}</td>
                                        <td>{{ $tagihan->Outlet->name_kios }}</td>
                                        <td>{{ $tagihan->nilai_kwh_awal }}</td>
                                        <td>{{ $tagihan->nilai_kwh_akhir }}</td>
                                        <td>{{ $tagihan->total_kwh }}</td>
                                        <td>{{ 'Rp '.number_format($tagihan->jumlah_tagihan,0,',','.') }}</td>
                                        <td>{{ $tagihan->periode }}</td>
                                        <td>{{ $tagihan->status_pembayaran }}</td>
                                        {{-- <td>{{ $outlet->User->name }}</td>
                                        <td>{{ $outlet->Typerate->type }}</td>
                                        <td>{{ $outlet->luas_kios }}</td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .animated -->
    {{-- akhir Content --}}
</div>
@endsection

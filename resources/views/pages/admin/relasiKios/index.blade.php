@extends('layouts.master')

@section('content')

<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>{{ $judul }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="">Dashboard</a></li>
                            <li class="active">{{ $judul }}</li>
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
                        <a href="{{ route('master-relasiKios.create') }}" class="btn btn-primary text-right">Tentukan Data kios</a>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="serial">#</th>
                                    <th>Nama Kios</th>
                                    <th>Luas Kios</th>
                                    <th>Lokasi Kios</th>
                                    <th>Tipe Kios</th>
                                    <th>Harga Kios</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($relasiDataKios as $dataKios)
                                <tr>
                                    <td class="serial">{{ $loop->iteration }}</td>
                                    <td>{{ $dataKios->Kios->nama_kios }}</td>
                                    <td>{{ $dataKios->Kios->luas_kios }}</td>
                                    <td>{{ $dataKios->Lokasi->nama_lokasi }}</td>
                                    <td>{{ $dataKios->TarifKios->tipe }}</td>
                                    <td>{{ 'Rp '.number_format($dataKios->TarifKios->harga,0,',','.') }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('master-kios.edit', $dataKios->id) }}" class="btn-sm badge-warning" style="font-size: 14px; border-radius:10px;"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</div>
{{-- akhir Content --}}
</div>
@endsection

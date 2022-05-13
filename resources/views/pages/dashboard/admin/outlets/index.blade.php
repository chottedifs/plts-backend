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
                        <a href="{{ route('outlet.create') }}" class="btn btn-primary text-right">Tambah kios</a>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="serial">#</th>
                                    <th>Nama Kios</th>
                                    <th>Pengguna Kios</th>
                                    <th>Tipe Tarif</th>
                                    <th>Luas Kios</th>
                                    <th>Status Kios</th>
                                    <th class="text-center">Konfirmasi Kios</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($outlets as $outlet)
                                <tr>
                                    <td class="serial">{{ $loop->iteration }}</td>
                                    <td>{{ $outlet->name_kios }}</td>
                                    <td>{{ $outlet->User->name }}</td>
                                    <td>{{ $outlet->Typerate->type }}</td>
                                    <td>{{ $outlet->luas_kios }}</td>
                                    <td>
                                        @if ($outlet->status_kios)
                                            <strong class="badge bg-success text-white">Kios ditempati</strong>
                                        @else
                                            <strong class="badge bg-danger text-white">Kios tidak ditempati</strong>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if (!$outlet->status_kios)
                                        <form action="{{ route('status-available', $outlet->id) }}" method="post">
                                            @csrf
                                            <button class="btn btn-success p-2" style="font-size: 14px; border-radius:10px;" target="_blank">
                                                Disewakan
                                            </button>
                                        </form>
                                        @else
                                        <form action="{{ route('status-notAvailable', $outlet->id) }}" method="post">
                                            @csrf
                                            <button class="btn btn-warning p-2" style="font-size: 14px; border-radius:10px;" target="_blank">
                                                Berhenti Sewa
                                            </button>
                                        </form>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('outlet.edit', $outlet->id) }}" class="btn-sm badge-warning" style="font-size: 14px; border-radius:10px;"><i class="fa fa-edit"></i></a>
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

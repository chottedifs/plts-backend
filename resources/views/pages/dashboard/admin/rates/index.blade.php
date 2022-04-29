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
                        <a href="{{ route('rate.create') }}" class="btn btn-primary">Tambah Tarif Kios</a>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Tipe Tarif</th>
                                    <th>Tarif Dasar Kios</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rates as $rate)
                                <tr>
                                    <td class="serial">{{ $loop->iteration }}</td>
                                    <td>{{ $rate->type }}</td>
                                    <td>{{ 'Rp.'.number_format($rate->price,0,',','.') }}</td>
                                    <td>
                                        <a href="{{route('rate.edit', $rate->id)}}" class="btn-sm badge-warning"><i class="fa fa-edit mr-2"></i>Edit Tarif</a>
                                        {{-- <form action="/admin/dashboard/rate/{{ $rate->id }}" method="post" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button class="btn-sm bg-danger text-white border-0" onclick="return confirm('Are You Sure!')"><i class="fa fa-trash-o"></i></button>
                                        </form> --}}
                                    </td>
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

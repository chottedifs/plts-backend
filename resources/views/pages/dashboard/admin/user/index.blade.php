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
                                {{-- <li><a href="{{route('user.index')}}">Dashboard</a></li> --}}
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
                            <a href="{{ route('user-kios.create') }}" class="btn btn-primary text-right">Tambah User</a>
                        </div>
                        <div class="card-body">
                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="serial">#</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>No.Hp</th>
                                        <th>Tipe Akses</th>
                                        <th>Aktif</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                    <tr>
                                        <td class="serial">{{ $loop->iteration }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone_number }}</td>
                                        <td>{{ $user->roles }}</td>
                                        <td>{{ $user->is_active }}</td>
                                        <td>
                                            <a href="{{route('user-kios.edit', $user->id)}}" class="badge badge-warning mt-2"><i class="fa fa-edit"></i></a>
                                            <button class="badge badge-success border-0 d-inline mt-2" data-toggle="modal" data-target="#largeModal{{ $user->id }}"><i class="fa fa-solid fa-eye"></i></button>
                                            <form action="{{route('user-kios.destroy', $user->id)}}" method="post" class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <button class="badge badge-danger border-0 mt-2" onclick="return confirm('Are You Sure!')"><i class="fa fa-times-circle"></i></button>
                                            </form>
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
{{-- Modals Detail --}}
{{-- Tampilan datanya di benerin --}}
{{-- @foreach($users as $user)
<div class="modal fade" id="largeModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="text-center fw-bold" id="largeModalLabel">Detail User {{ $user->name }}</h5>
            </div>
            <div class="modal-body">
                <h4 class="pb-2">Name &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;: {{ $user->name }}</h4>
                <h4 class="pb-2">Email &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; : {{ $user->email }}</h4>
                <h4 class="pb-2">Outlet&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;: {{ $user->outlet->name_kios }}</h4>
                <h4 class="pb-2">Type  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;: {{ $user->outlet->rate->type }}</h4>
                <h4 class="pb-2">Price  &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;: Rp.{{ number_format($user->outlet->rate->price,0,',','.') }}</h4>
                <h4 class="pb-2">Phone Number : {{ $user->phone_number }}</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
            </div>
        </div>
    </div>
</div>
@endforeach --}}

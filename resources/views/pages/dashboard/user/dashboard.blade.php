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
                        <a href="{{ route('user.create') }}" class="btn btn-primary text-right">Tambah User</a>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="serial">#</th>
                                    <th>Nama</th>
                                    <th>No.Hp</th>
                                    <th>Nama Kios</th>
                                    <th>Tipe Tarif</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td class="serial">{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->phone_number }}</td>
                                    <td>{{ $user->outlet->name_kios }}</td>
                                    <td>{{ $user->outlet->rate->type }}</td>
                                    <td>
                                        <a href="{{route('user.edit', $user->id)}}" class="badge badge-warning"><i class="fa fa-edit"></i></a>
                                        <button class="badge badge-success border-0 d-inline" data-toggle="modal" data-target="#largeModal{{ $user->id }}"><i class="fa fa-solid fa-eye"></i></button> 
                                        <form action="{{route('user.destroy', $user->id)}}" method="post" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button class="badge badge-danger border-0" onclick="return confirm('Are You Sure!')"><i class="fa fa-times-circle"></i></button>
                                        </form>
                                    </td>
                                    {{-- <td>
                                        @if ($outlet->status_kios)
                                            <strong class="badge bg-success text-white">Kios ditempati</strong>
                                        @else
                                            <strong class="badge bg-danger text-white">Kios tidak ditempati</strong>
                                        @endif
                                    </td> --}}
                                    {{-- <td class="text-center">
                                        @if (!$user->outlet->status_kios)
                                        <form action="{{ route('status-available', $user->id) }}" method="post">
                                            @csrf
                                            <button class="btn btn-success p-2" style="font-size: 14px; border-radius:10px;" target="_blank">
                                                Disewakan
                                            </button>
                                        </form>
                                        @else
                                        <form action="{{ route('status-notAvailable', $user->id) }}" method="post">
                                            @csrf
                                            <button class="btn btn-warning p-2" style="font-size: 14px; border-radius:10px;" target="_blank">
                                                Berhenti Sewa
                                            </button>
                                        </form>
                                        @endif
                                    </td> --}}
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
@foreach($users as $user)
<div class="modal fade" id="largeModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="largeModalLabel">Large Modal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4>Name : {{ $user->name }}</h4>
                <h4>Email : {{ $user->email }}</h4>
                <h4>Outlet & type : {{ $user->outlet->name_kios }} & {{ $user->outlet->rate->type }} {{ $user->outlet->rate->price }}</h4>
                <h4>Phone Number : {{ $user->phone_number }}</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
            </div>
        </div>
    </div>    
</div>
@endforeach

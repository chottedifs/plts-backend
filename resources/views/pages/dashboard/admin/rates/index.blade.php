@extends('layouts.master')

@section('content')
<div class="content">
    <!-- Animated -->
    <div class="animated fadeIn">
        <!--  /Traffic -->
        <div class="clearfix"></div>
        <a href="/admin/dashboard/rate/create" class="btn btn-primary mb-3">Create New Rate</a>
        
        {{-- Content --}}
        <div class="content">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            @if (session()->has('success'))
                                <div class="alert alert-success my-2" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <div class="card-header">
                                <strong class="card-title">Data Table</strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Type Rate</th>
                                            <th>Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($rates as $rate)
                                        <tr>
                                            <td class="serial">{{ $loop->iteration }}</td>
                                            <td>{{ $rate->type }}</td>
                                            <td>{{ $rate->price }}</td>
                                            <td>
                                                <a href="/admin/dashboard/rate/{{ $rate->id }}/edit" class="btn-sm badge-warning"><i class="fa fa-edit"></i></a>
                                                <form action="/admin/dashboard/rate/{{ $rate->id }}" method="post" class="d-inline">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="btn-sm bg-danger text-white border-0" onclick="return confirm('Are You Sure!')"><i class="fa fa-trash-o"></i></button>
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
            </div><!-- .animated -->
        {{-- akhir Content --}}
    <!-- /#add-category -->
    </div>
    <!-- .animated -->
</div>
@endsection

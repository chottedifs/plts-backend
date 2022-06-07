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
                        @can('plts')
                            <div class="float-right">
                                <a href="{{ route('export-tagihan') }}" class="btn btn-success text-right" style="border-radius: 10px;"><i class="fa-solid fa-file-export mr-2"></i> Template Tagihan </a>
                                <button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary text-right" style="border-radius: 10px;"><i class="fa-solid fa-cloud-arrow-up mr-2"></i>Upload Tagihan</button>
                                <a href="{{ route('export-laporan') }}" class="btn btn-success text-right" style="border-radius: 10px;"><i class="fa-solid fa-cloud-arrow-down mr-2"></i> Download Report </a>
                            </div>
                        @endcan
                        <form class="form-inline" action="{{ route('tagihan-index') }}" method="get">
                            @csrf
                            <div class="form-group mx-sm-3 mb-2">
                            <label for="bulanTagihan" class="mr-2">Periode Tagihan</label>
                            <input type="month" class="form-control" name="bulanTagihan" id="bulanTagihan" value="{{ old('bulanTagihan', $periode) }}">
                            </div>
                            <button type="submit" class="btn btn-primary mb-2" style="border-radius: 10px;">Cari Tagihan</button>
                        </form>
                    </div>
                    <div class="card-body">
                        @include('pages.admin.tagihan.table')
                    </div>
                </div>
            </div>
        </div>
</div>
{{-- akhir Content --}}
</div>
@endsection



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Masukan Template Tagihan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{ route('import-tagihan') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <label for="file">Masukan template</label>
                <input type="file" name="import-file" id="import-file" required>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
        </div>
    </div>
</div>

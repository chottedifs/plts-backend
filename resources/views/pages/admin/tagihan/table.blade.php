<table id="bootstrap-data-table" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th class="serial">#</th>
            <th>Nama Penyewa</th>
            <th>Kios</th>
            <th>Lokasi</th>
            <th>Total Kwh</th>
            <th>Tagihan Kwh</th>
            <th>Tagihan Kios</th>
            <th>Total Tagihan</th>
            <th>Periode</th>
            <th>Status Bayar</th>
            @can('plts')
                <th class="text-center">Action</th>
            @endcan
        </tr>
    </thead>
    <tbody>
        @foreach ($dataTagihan as $tagihan)
        <tr>
            <td class="serial">{{ $loop->iteration }}</td>
            <td>{{ $tagihan->SewaKios->User->nama_lengkap }}</td>
            <td>{{ $tagihan->SewaKios->RelasiKios->Kios->nama_kios }}</td>
            <td>{{ $tagihan->Lokasi->nama_lokasi }}</td>
            <td>{{ $tagihan->total_kwh }}</td>
            <td>{{ 'Rp '.number_format($tagihan->tagihan_kwh,0,',','.') }}</td>
            <td>{{ 'Rp '.number_format($tagihan->tagihan_kios,0,',','.') }}</td>
            <td>{{ 'Rp '.number_format($tagihan->total_tagihan,0,',','.') }}</td>
            <td>{{  date('M Y', strtotime($tagihan->periode)) }}</td>
            <td>
                @if($tagihan->status_bayar == 1)
                    <div class="badge bg-success text-wrap">
                        Terbayar
                    </div>
                @elseif ($tagihan->status_bayar == 0)
                    <div class="badge bg-danger text-wrap">
                        Belum Terbayar
                    </div>
                @endif
            </td>
            @can('plts')
            <td class="text-center">
                <a href="{{ route('tagihan.edit', $tagihan->id) }}" class="btn-sm badge-warning" style="font-size: 14px; border-radius:10px;"><i class="fa fa-edit"></i></a>
            </td>
            @endcan
        </tr>
        @endforeach
    </tbody>
</table>

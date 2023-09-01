<div class="col-12">
    <h1 class="h3 mb-3">Pelanggan : {{ $data[0]->pelanggan->nama_pelanggan }}</h1>
    <table class="table table-striped-columns">
        <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Tanggal</th>
              <th scope="col">Setoran</th>
              <th scope="col">Total Nota</th>
              <th scope="col">Keterangan</th>
              <th scope="col">Nota</th>
              {{-- <th scope="col"></th> --}}
            </tr>
          </thead>
          
          <tbody>
            <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
            @php
            $no = 1
            @endphp
            @foreach($data as $item)
            <tr>
                <th scope="row">{{ $no++ }}</th>
                <td>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}</td>
                <td>Rp. {{ $item->setoran }}</td>
                <td>Rp. {{ $item->hutang }}</td>
                <td>{{ $item->keterangan }}</td>
                <td><a href={{ asset('storage/'.$item->nota) }} target="_blank"><i class="bi bi-card-image" role="button"></i></a></td>
                  {{-- <td><i class="bi bi-pencil-square" style="margin-right: 5px; color: green; cursor: pointer" onClick="event.preventDefault();edit({{ $item->id }})"></i>
                    <i class="bi bi-x-square-fill" style="color: #f43737; cursor: pointer" onClick="event.preventDefault();destroy({{ $item->id }})"></i>
                </td> --}}
            </tr>
            @endforeach
            <tr>
                <th style="border-top: 2px solid">Total</th>
                <td style="border-top: 2px solid"></td>
                <td style="border-top: 2px solid">Rp. {{ $total_setoran }}</td>
                <td style="border-top: 2px solid">Rp. {{ $total_hutang }}</td>
                <td style="border-top: 2px solid"></td>
                <td style="border-top: 2px solid"></td>
            </tr>
          </tbody>
    </table>

    @if($total_hutang >= $total_setoran)
    <h6 class="h4 mb-3">Sisa Hutang : Rp. {{ $total_hutang > $total_setoran ?  $total_hutang - $total_setoran : 0 }}</h6>
    @else
    <h6 class="h4 mb-3">Sisa Saldo : Rp. {{ $total_hutang < $total_setoran ? $total_setoran - $total_hutang : 0 }}</h6>
    @endif
</div>
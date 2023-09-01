<div class="col-12">
    <table class="table table-striped-columns">
        <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Tanggal</th>
              <th scope="col">Nama Pelanggan</th>
              <th scope="col">Nama Barang</th>
              <th scope="col">Harga Jual</th>
              <th scope="col">Jumlah</th>
              <th scope="col">Total</th>
              <th scope="col">Setoran</th>
              <th scope="col">Nota</th>
              <th scope="col"></th>
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
                <td style="vertical-align: top">{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}</td>
                <td style="vertical-align: top">{{ $item->pelanggan->nama_pelanggan }}</td>
                <td style="vertical-align: top">
                  @foreach($item->barang as $barang)
                  <p>{{ $barang->stok_barang->nama_barang }}</p>
                  @endforeach
                </td>
                <td style="vertical-align: top">
                  @foreach($item->barang as $barang)
                  <p>Rp. {{ $barang->harga_jual }}</p>
                  @endforeach
                </td>
                <td style="vertical-align: top">
                  @foreach($item->barang as $barang)
                  <p>{{ $barang->jumlah }} {{ $barang->stok_barang->satuan }}</p>
                  @endforeach
                </td>
                <td style="vertical-align: top">
                  @foreach($item->barang as $barang)
                  <p>Rp. {{ $barang->jumlah * $barang->harga_jual }}</p>
                  @endforeach
                </td>
                <td style="vertical-align: top">Rp. {{ $item->setoran }}</td>
                <td style="vertical-align: top"><a href={{ asset('storage/'.$item->nota) }} target="_blank"><i class="bi bi-card-image" role="button"></i></a></td>
                <td style="vertical-align: top"><i class="bi bi-pencil-square" style="margin-right: 5px; color: green; cursor: pointer" onClick="event.preventDefault();edit({{ $item->id }})"></i>
                    <i class="bi bi-x-square-fill" style="color: #f43737; cursor: pointer" onClick="event.preventDefault();destroy({{ $item->id }})"></i>
                </td>
            </tr>
            @endforeach
          </tbody>
    </table>
</div>
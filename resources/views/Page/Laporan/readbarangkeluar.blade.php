<div class="col-12">
    <table class="table table-striped-columns">
        <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Tanggal</th>
              <th scope="col">Nama Barang</th>
              <th scope="col">Harga Jual</th>
              <th scope="col">Jumlah</th>
              <th scope="col">Satuan</th>
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
                <td>{{ $item->stok_barang->nama_barang }}</td>
                <td>Rp. {{ $item->harga_jual ? $item->harga_jual : "-" }}</td>
                <td>{{ $item->jumlah }}</td>
                <td>{{ $item->stok_barang->satuan }}</td>
            </tr>
            @endforeach
          </tbody>
    </table>
</div>
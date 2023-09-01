<div class="col-12">
    <table class="table table-striped-columns">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama Barang</th>
                <th scope="col">Satuan</th>
                <th scope="col">Stok</th>
                <th scope="col"></th>
            </tr>
        </thead>

        <tbody>
            <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
            @php
                $no = 1;
            @endphp
            @foreach ($data as $item)
                <tr>
                    <th scope="row">{{ $no++ }}</th>
                    <td>{{ $item->nama_barang }}</td>
                    <td>{{ $item->satuan }}</td>
                    <td>{{ $item->stok }}</td>
                    <td><i class="bi bi-pencil-square" style="margin-right: 5px; color: green; cursor: pointer"
                            onClick="event.preventDefault();editstokbarang({{ $item->id }})"></i>
                        {{-- <i class="bi bi-x-square-fill" style="color: #f43737; cursor: pointer" onClick="event.preventDefault();destroy({{ $item->id }})"></i> --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

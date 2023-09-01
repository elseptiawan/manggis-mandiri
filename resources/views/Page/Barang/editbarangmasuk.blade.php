<div class="p2">
    <form class="form-floating">
        <div class="form-group">
            <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
            <label for="nama_barang">Nama Barang</label>
            <input type="text" name="nama_barang" id="nama_barang" class="form-control mb-2"
                value="{{ $data->stok_barang->nama_barang }}" readonly>
            <label for="nama_barang">Harga Beli</label>
            <input type="number" name="harga_beli" id="harga_beli" class="form-control mb-2" placeholder="Harga Beli"
                value={{ $data->harga_beli }}>
            <label for="nama_barang">Jumlah</label>
            <input type="number" name="jumlah" id="jumlah" class="form-control mb-2" placeholder="Jumlah"
                value={{ $data->jumlah }}>
            {{-- <label for="nama_barang">Satuan</label>
            <input type="text" name="satuan" id="satuan" class="form-control mb-2" placeholder="Satuan"
                value={{ $data->satuan }}> --}}
        </div>
        <div class="form-group mt-2">
            <button class="btn btn-success" onClick="event.preventDefault();updatebarangmasuk({{ $data->id }})">Simpan</button>
        </div>
    </form>
</div>

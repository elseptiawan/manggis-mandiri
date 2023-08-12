<div class="p2">
    <form class="form-floating">
        <div class="form-group">
            <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
            <div class="form-floating">
                <input type="text" name="nama_barang" id="nama_barang" class="form-control mb-2" value="{{ $data->nama_barang }}">
                <label for="nama_barang">Nama Barang</label>
            </div>
            <div class="form-floating">
                <input type="number" name="harga_beli" id="harga_beli" class="form-control mb-2" placeholder="Harga Beli" value={{ $data->harga_beli }}>
                <label for="nama_barang">Harga Beli</label>
            </div>
            <div class="form-floating">
                <input type="number" name="jumlah" id="jumlah" class="form-control mb-2" placeholder="Jumlah" value={{ $data->jumlah }}>
                <label for="nama_barang">Jumlah</label>
            </div>
            <div class="form-floating">
                <input type="text" name="satuan" id="satuan" class="form-control mb-2" placeholder="Satuan" value={{ $data->satuan }}>
                <label for="nama_barang">Satuan</label>
            </div>
        </div>
        <div class="form-group mt-2">
            <button class="btn btn-success" onClick="event.preventDefault();update({{ $data->id }})">Simpan</button>
        </div>
    </form>
</div>
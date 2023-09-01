<div class="p2">
    <form class="form-floating">
        <div class="form-group">
            <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
            <label for="nama_barang">Nama Barang</label>
            <input type="text" name="nama_barang" id="nama_barang" class="form-control mb-2"
                value="{{ $data->nama_barang }}">
            <label for="satuan">Satuan</label>
            <input type="text" name="satuan" id="satuan" class="form-control mb-2" value="{{ $data->satuan }}">
            <label for="stok">Stok</label>
            <input type="number" name="stok" id="stok" class="form-control mb-2" value={{ $data->stok }} readonly>
        </div>
        <div class="form-group mt-2">
            <button class="btn btn-success"
                onClick="event.preventDefault();updatestokbarang({{ $data->id }})">Simpan</button>
        </div>
    </form>
</div>

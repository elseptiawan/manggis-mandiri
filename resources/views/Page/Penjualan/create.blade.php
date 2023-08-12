<div class="p2">
    <form class="form-floating">
        <div class="form-group">
            <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
            <select id="pelanggan_id" class="form-select form-select-sm mb-3 p-2" aria-label=".form-select-sm example">
                <option selected disabled hidden>Nama Pelanggan</option>
                @foreach($data as $item)
                    <option style="padding: 50px;" value={{ $item->id }}>{{ $item->nama_pelanggan }}</option>
                @endforeach
              </select>
            <div class="form-floating">
                <input type="text" name="nama_barang" id="nama_barang" class="form-control mb-2">
                <label for="nama_barang">Nama Barang</label>
            </div>
            <div class="form-floating">
                <input type="number" name="harga_jual" id="harga_jual" class="form-control mb-2">
                <label for="harga_jual">Harga Jual</label>
            </div>
            <div class="form-floating">
                <input type="number" name="jumlah" id="jumlah" class="form-control mb-2">
                <label for="jumlah">Jumlah</label>
            </div>
            <div class="form-floating">
                <input type="text" name="satuan" id="satuan" class="form-control mb-2">
                <label for="satuan">Satuan</label>
            </div>
            <div class="form-floating">
                <input type="number" name="setoran" id="setoran" class="form-control mb-2">
                <label for="setoran">Setoran</label>
            </div>
        </div>
        <div class="form-group mt-2">
            <button class="btn btn-success" onClick="event.preventDefault();store()">Simpan</button>
        </div>
    </form>
</div>
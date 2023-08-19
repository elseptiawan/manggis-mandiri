<div class="p2">
    <form class="form-floating">
        <div class="form-group">
            <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
            <label for="pelanggan_id">Pelanggan <span style="color: red">*</span></label>
            <select id="pelanggan_id" class="form-select form-select-sm mb-3 p-2" aria-label=".form-select-sm example">
                <option selected disabled hidden>Nama Pelanggan</option>
                @foreach($data as $item)
                    <option style="padding: 50px;" value={{ $item->id }}>{{ $item->nama_pelanggan }}</option>
                @endforeach
              </select>
            <label for="nama_barang">Nama Barang <span style="color: red">*</span></label>
            <input type="text" name="nama_barang" id="nama_barang" class="form-control mb-2" required>
            <label for="harga_jual">Harga Jual <span style="color: red">*</span></label>
            <input type="number" name="harga_jual" id="harga_jual" class="form-control mb-2" required>
            <label for="jumlah">Jumlah <span style="color: red">*</span></label>
            <input type="number" name="jumlah" id="jumlah" class="form-control mb-2" required>
            <label for="satuan">Satuan <span style="color: red">*</span></label>
            <input type="text" name="satuan" id="satuan" class="form-control mb-2" required>
            <label for="setoran">Setoran <span style="color: red">*</span></label>
            <input type="number" name="setoran" id="setoran" class="form-control mb-2" required>
            <label for="nota">Nota <span style="color: red">*</span></label>
            <input type="file" name="nota" id="nota" class="form-control mb-2" required>
        </div>
        <div class="form-group mt-2">
            <button class="btn btn-success" onClick="event.preventDefault();store()">Simpan</button>
        </div>
    </form>
</div>
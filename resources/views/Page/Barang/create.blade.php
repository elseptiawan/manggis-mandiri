<div class="p2">
    <form class="form-floating">
        <div class="form-group">
            <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
            <label for="nama_barang">Nama Barang <span style="color: red">*</span></label>
            <input type="text" name="nama_barang" id="nama_barang" class="form-control mb-2" >
            <label for="harga_beli">Harga Beli <span style="color: red">*</span></label>
            <input type="number" name="harga_beli" id="harga_beli" class="form-control mb-2" >
            <label for="jumlah">Jumlah <span style="color: red">*</span></label>
            <input type="number" name="jumlah" id="jumlah" class="form-control mb-2" >
            <label for="satuan">Satuan <span style="color: red">*</span></label>
            <input type="text" name="satuan" id="satuan" class="form-control mb-2" >
        </div>
        <div class="form-group mt-2">
            <button class="btn btn-success" onClick="event.preventDefault();store()">Simpan</button>
        </div>
    </form>
</div>
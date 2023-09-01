<div class="p2">
    <form class="form-floating">
        <div class="form-group">
            <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
            <label for="tanggal">Tanggal <span style="color: red">*</span></label>
            <input type='text' id="tanggal" class="form-control mb-3" placeholder="Pilih Tanggal" />
            <label for="id_barang">Nama Barang <span style="color: red">*</span></label>
            <select id="id_barang" class="form-select form-select-sm mb-3 p-2" aria-label=".form-select-sm example" onchange="onChangeNamaBarang(this.value)">
                <option selected disabled hidden>Pilih Nama Barang</option>
                @foreach ($barang as $item)
                    <option style="padding: 50px;" value={{ $item->id }}>{{ $item->nama_barang }}</option>
                @endforeach
                <option style="padding: 50px;" value=0>Tambahkan Barang Baru</option>
            </select>
            <div id="input_nama_barang"></div>
            {{-- <label for="nama_barang">Nama Barang <span style="color: red">*</span></label>
            <input type="text" name="nama_barang" id="nama_barang" class="form-control mb-2"> --}}
            <label for="harga_beli">Harga Beli <span style="color: red">*</span></label>
            <input type="number" name="harga_beli" id="harga_beli" class="form-control mb-2">
            <label for="jumlah">Jumlah <span style="color: red">*</span></label>
            <input type="number" name="jumlah" id="jumlah" class="form-control mb-2">
            {{-- <label for="satuan">Satuan <span style="color: red">*</span></label>
            <input type="text" name="satuan" id="satuan" class="form-control mb-2"> --}}
        </div>
        <div class="form-group mt-2">
            <button class="btn btn-success" onClick="event.preventDefault();store()">Simpan</button>
        </div>
    </form>
</div>

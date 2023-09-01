<div class="p2">
    <form class="form-floating">
        <div class="form-group">
            <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
            <label for="pelanggan_id">Pelanggan <span style="color: red">*</span></label>
            <select id="pelanggan_id" class="form-select form-select-sm mb-3 p-2" aria-label=".form-select-sm example">
                <option selected disabled hidden>Nama Pelanggan</option>
                @foreach ($data as $item)
                    <option style="padding: 50px;" value={{ $item->id }}>{{ $item->nama_pelanggan }}</option>
                @endforeach
            </select>
            <label for="tanggal">Tanggal <span style="color: red">*</span></label>
            <input type='text' id="tanggal" class="form-control mb-3" placeholder="Pilih Tanggal" />
            <div id="add-input-barang">
                <div class="d-flex mb-3">
                    <div style="margin-right: 15px" class="w-25">
                        <label for="nama_barang">Nama Barang <span style="color: red">*</span></label>
                        <select name="id_barang[0]" class="form control form-select form-select-sm mb-2 p-2"
                            aria-label=".form-select-sm example">
                            <option selected disabled hidden>Pilih Barang</option>
                            @foreach ($barang as $item)
                                <option style="padding: 50px;" value={{ $item->id }}>{{ $item->nama_barang }} <span
                                        class="text-muted">(stok: {{ $item->stok }})</span>
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div style="margin-right: 15px" class="w-25">
                        <label for="harga_jual">Harga Jual <span style="color: red">*</span></label>
                        <input type="number" name="harga_jual[0]" id="harga_jual" class="form-control mb-2 p-2"
                            required>
                    </div>
                    <div style="margin-right: 15px" class="w-25">
                        <label for="jumlah">Jumlah <span style="color: red">*</span></label>
                        <input type="number" name="jumlah[0]" id="jumlah" class="form-control mb-2 p-2" required>
                    </div>
                    <button type="button" name="add" id="dynamicAdd" class="btn btn-outline-primary p-2"
                        style="height: 50%; margin-top: 20px" onClick="addBarang()">Tambah Barang</button>
                </div>
            </div>
            <label for="setoran">Setoran <span style="color: red">*</span></label>
            <input type="number" name="setoran" id="setoran" class="form-control mb-2" required>
            {{-- <label for="nota">Nota <span style="color: red">*</span></label>
            <input type="file" name="nota" id="nota" class="form-control mb-2" required> --}}
        </div>
        <div class="form-group mt-2">
            <button class="btn btn-success" onClick="event.preventDefault();store()">Simpan</button>
        </div>
    </form>
</div>

<div class="p2">
    <form class="form-floating">
        <div class="form-group">
            <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
            <label for="pelanggan_id">Pelanggan <span style="color: red">*</span></label>
            <select id="pelanggan_id" name="pelanggan_id" class="form-select form-select-sm mb-3 p-2"
                aria-label=".form-select-sm example" onchange="getSisaHutang(this.value)">
                <option selected disabled hidden>Nama Pelanggan</option>
                @foreach ($pelanggan as $item)
                    <option style="padding: 50px;" value={{ $item->id }}>{{ $item->nama_pelanggan }}</option>
                @endforeach
            </select>
            <div id="sisaHutang"></div>
            <label for="tanggal">Tanggal <span style="color: red">*</span></label>
            <input type='text' id="tanggal" class="form-control mb-3" placeholder="Pilih Tanggal" />
            <label for="setoran">Setoran</label>
            <input type="number" name="setoran" id="setoran" class="form-control mb-2">
            {{-- <label for="hutang">Hutang</label>
            <input type="number" name="hutang" id="hutang" class="form-control mb-2"> --}}
            <label for="keterangan">Keterangan <span style="color: red">*</span></label>
            <input type="text" name="keterangan" id="keterangan" class="form-control mb-2">
            {{-- <label for="nota">Nota <span style="color: red">*</span></label>
            <input type="file" name="nota" id="nota" class="form-control mb-2"> --}}
        </div>
        <div class="form-group mt-2">
            <button class="btn btn-success" onClick="event.preventDefault();store()">Simpan</button>
        </div>
    </form>
</div>

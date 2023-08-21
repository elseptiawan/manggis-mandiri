<div class="p2">
    <form class="form-floating">
        <div class="form-group">
            <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
            <label for="nama_karyawan">Nama Karyawan <span style="color: red">*</span></label>
            <input type="text" name="nama_karyawan" id="nama_karyawan" class="form-control mb-2" value="{{ $data->nama_karyawan }}">
            <label for="posisi">Posisi <span style="color: red">*</span></label>
            <select id="posisi" name="posisi" class="form-select form-select-sm mb-3 p-2" aria-label=".form-select-sm example">
                <option selected disabled hidden>Posisi Karyawan</option>
                <option value="Pemilik Toko" @if($data->posisi == "Pemilik Toko") selected @endif>Pemilik Toko</option>
                <option value="Administrasi" @if($data->posisi == "Administrasi") selected @endif>Administrasi</option>
                <option value="Pelayan Toko" @if($data->posisi == "Pelayan Toko") selected @endif>Pelayan Toko</option>
                <option value="Gudang" @if($data->posisi == "Gudang") selected @endif>Gudang</option>
                <option value="Supir" @if($data->posisi == "Supir") selected @endif>Supir</option>
            </select>
            <label for="no_hp">Nomor HP <span style="color: red">*</span></label>
            <input type="text" name="no_hp" id="no_hp" class="form-control mb-2" value="{{ $data->no_hp }}">
        </div>
        <div class="form-group mt-2">
            <button class="btn btn-success" onClick="event.preventDefault();store()">Simpan</button>
        </div>
    </form>
</div>
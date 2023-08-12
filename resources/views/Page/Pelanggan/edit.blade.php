<div class="p2">
    <form class="form-floating">
        <div class="form-group">
            <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
            <div class="form-floating">
                <input type="text" name="nama_pelanggan" id="nama_pelanggan" class="form-control mb-2" value="{{ $data->nama_pelanggan }}">
                <label for="nama_pelanggan">Nama Pelanggan</label>
            </div>
            <div class="form-floating">
                <input type="text" name="alamat" id="alamat" class="form-control mb-2" value="{{ $data->alamat }}">
                <label for="alamat">Alamat</label>
            </div>
            <div class="form-floating">
                <input type="text" name="no_hp" id="no_hp" class="form-control mb-2" value="{{ $data->no_hp }}">
                <label for="no_hp">Nomor HP</label>
            </div>
        </div>
        <div class="form-group mt-2">
            <button class="btn btn-success" onClick="event.preventDefault();update({{ $data->id }})">Simpan</button>
        </div>
    </form>
</div>
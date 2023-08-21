<div class="p2">
    <form class="form-floating">
        <div class="form-group">
            <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
            <label for="nama_pelanggan">Nama Pelanggan <span style="color: red">*</span></label>
            <input type="text" name="nama_pelanggan" id="nama_pelanggan" class="form-control mb-2">
            <label for="alamat">Alamat <span style="color: red">*</span></label>
            <input type="text" name="alamat" id="alamat" class="form-control mb-2">
            <label for="no_hp">Nomor HP <span style="color: red">*</span></label>
            <input type="text" name="no_hp" id="no_hp" class="form-control mb-2">
            <label for="email">Email <span style="color: red">*</span></label>
            <input type="text" name="email" id="email" class="form-control mb-2">
            <label for="password">Password <span style="color: red">*</span></label>
            <input type="password" name="password" id="password" class="form-control mb-2">
            <label for="confirm_password">Konfirmasi Password <span style="color: red">*</span></label>
            <input type="password" name="confirm_password" id="confirm_password" class="form-control mb-2">
        </div>
        <div class="form-group mt-2">
            <button class="btn btn-success" onClick="event.preventDefault();store()">Simpan</button>
        </div>
    </form>
</div>
<div class="p2">
    <form class="form-floating">
        <div class="form-group">
            <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
            <label for="nama_karyawan">Nama Karyawan <span style="color: red">*</span></label>
            <input type="text" name="nama_karyawan" id="nama_karyawan" class="form-control mb-2">
            <label for="posisi">Posisi <span style="color: red">*</span></label>
            <select id="posisi" name="posisi" class="form-select form-select-sm mb-3 p-2" aria-label=".form-select-sm example">
                <option selected disabled hidden>Posisi Karyawan</option>
                <option value="Pemilik Toko">Pemilik Toko</option>
                <option value="Administrasi">Administrasi</option>
                <option value="Pelayan Toko">Pelayan Toko</option>
                <option value="Gudang">Gudang</option>
                <option value="Supir">Supir</option>
            </select>
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
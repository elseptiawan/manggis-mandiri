<div class="p2">
    <form class="form-floating">
        <div class="form-group">
            <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
            <label for="pelanggan_id">Pelanggan <span style="color: red">*</span></label>
            <select id="pelanggan_id" class="form-select form-select-sm mb-3 p-2" aria-label=".form-select-sm example">
                <option selected disabled hidden>Nama Pelanggan</option>
                @foreach ($data as $item)
                    <option style="padding: 50px;" value={{ $item->id }}
                        @if ($item->id == $penjualan->pelanggan_id) selected @endif>{{ $item->nama_pelanggan }}</option>
                @endforeach
            </select>
            <label for="tanggal">Tanggal <span style="color: red">*</span></label>
            <input type='text' id="tanggal" class="form-control mb-3" value="{{ \Carbon\Carbon::parse($penjualan->tanggal)->format('d-m-Y') }}" />
            <div class="add-input-barang">
                @php
                    $i = 0;
                @endphp
                @foreach ($penjualan->barang as $barang)
                    <div class="d-flex mb-3">
                        <div style="margin-right: 15px">
                            <label for="nama_barang">Nama Barang <span style="color: red">*</span></label>
                            <input type="text" name="nama_barang[{{ $i }}]" id="nama_barang"
                                class="form-control mb-2" value="{{ $barang->stok_barang->nama_barang }}" required>
                        </div>
                        <div style="margin-right: 15px">
                            <label for="harga_jual">Harga Jual <span style="color: red">*</span></label>
                            <input type="number" name="harga_jual[{{ $i }}]" id="harga_jual"
                                class="form-control mb-2" value="{{ $barang->harga_jual }}" required>
                        </div>
                        <div style="margin-right: 15px">
                            <label for="jumlah">Jumlah <span style="color: red">*</span></label>
                            <input type="number" name="jumlah[{{ $i }}]" id="jumlah"
                                class="form-control mb-2" value="{{ $barang->jumlah }}" required>
                        </div>
                        <div style="margin-right: 15px">
                            <label for="satuan">Satuan <span style="color: red">*</span></label>
                            <input type="text" name="satuan[{{ $i }}]" id="satuan"
                                class="form-control mb-2" value="{{ $barang->stok_barang->satuan }}" required>
                        </div>
                    </div>
                    @php
                        $i++;
                    @endphp
                @endforeach
            </div>
            <label for="setoran">Setoran <span style="color: red">*</span></label>
            <input type="number" name="setoran" id="setoran" class="form-control mb-2"
                value="{{ $penjualan->setoran }}" required>
            {{-- <label for="nota">Nota</label>
            <input type="file" name="nota" id="nota" class="form-control mb-2" required> --}}
        </div>
        <div class="form-group mt-2">
            <button class="btn btn-success"
                onClick="event.preventDefault();update({{ $penjualan->id }})">Simpan</button>
        </div>
    </form>
</div>

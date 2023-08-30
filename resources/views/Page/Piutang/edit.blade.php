<div class="p2">
    <form class="form-floating">
        <div class="form-group">
            <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
            <label for="pelanggan_id">Pelanggan <span style="color: red">*</span></label>
            <select id="pelanggan_id" name="pelanggan_id" class="form-select form-select-sm mb-3 p-2"
                aria-label=".form-select-sm example" onchange="getSisaHutang(this.value)">
                <option selected disabled hidden>Nama Pelanggan</option>
                @foreach ($pelanggan as $item)
                    <option style="padding: 50px;" value={{ $item->id }}
                        @if ($item->id == $data->pelanggan->id) selected @endif>{{ $item->nama_pelanggan }}</option>
                @endforeach
            </select>
            <div id="sisaHutang">
                <label for="sisa_hutang">Sisa Hutang</label>
                <input type='text' id="sisa_hutang" class="form-control mb-3" value="{{ $sisa_hutang }}" readonly />
                <label for="sisa_saldo">Sisa Saldo</label>
                <input type='text' id="sisa_saldo" class="form-control mb-3" value="{{ $sisa_saldo }}" readonly />
            </div>
            <label for="tanggal">Tanggal <span style="color: red">*</span></label>
            <input type='text' id="tanggal" class="form-control mb-3"
                value="{{ \Carbon\Carbon::parse($data->tanggal)->format('d-m-Y') }}" />
            <label for="setoran">Setoran</label>
            <input type="text" name="setoran" id="setoran" class="form-control mb-2" value="{{ $data->setoran }}">
            {{-- <label for="hutang">Hutang</label>
            <input type="text" name="hutang" id="hutang" class="form-control mb-2" value="{{ $data->hutang }}"> --}}
            <label for="keterangan">Keterangan <span style="color: red">*</span></label>
            <input type="text" name="keterangan" id="keterangan" class="form-control mb-2"
                value="{{ $data->keterangan }}">
            {{-- <label for="nota">Nota</label>
            <input type="file" name="nota" id="nota" class="form-control mb-2"> --}}
        </div>
        <div class="form-group mt-2">
            <button class="btn btn-success" onClick="event.preventDefault();update({{ $data->id }})">Simpan</button>
        </div>
    </form>
</div>

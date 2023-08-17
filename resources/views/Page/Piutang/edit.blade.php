<div class="p2">
    <form class="form-floating">
        <div class="form-group">
            <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
            <div class="form-floating">
                <input type="text" name="setoran" id="setoran" class="form-control mb-2" value="{{ $data->setoran }}">
                <label for="setoran">Setoran</label>
            </div>
        </div>
        <div class="form-group mt-2">
            <button class="btn btn-success" onClick="event.preventDefault();update({{ $data->id }})">Bayar</button>
        </div>
    </form>
</div>
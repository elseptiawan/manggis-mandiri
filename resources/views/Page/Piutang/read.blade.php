<div class="col-12">
    <table class="table table-striped-columns">
        <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nama Pelanggan</th>
              <th scope="col">Setoran</th>
              <th scope="col">Hutang</th>
              <th scope="col">Nota</th>
              <th scope="col"></th>
            </tr>
          </thead>
          
          <tbody>
            <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
            @php
            $no = 1
            @endphp
            @foreach($data as $item)
            <tr>
                <th scope="row">{{ $no++ }}</th>
                <td>{{ $item->pelanggan->nama_pelanggan }}</td>
                <td>{{ $item->setoran }}</td>
                <td>{{ $item->hutang }}</td>
                <td><a href={{ asset('storage/'.$item->nota) }} target="_blank"><i class="bi bi-receipt" role="button"></i></a></td>
                <td>
                  <td><i class="bi bi-pencil-square" style="margin-right: 5px; color: green; cursor: pointer" onClick="event.preventDefault();edit({{ $item->id }})"></i>
                    <i class="bi bi-x-square-fill" style="color: #f43737; cursor: pointer" onClick="event.preventDefault();destroy({{ $item->id }})"></i>
                </td>
            </tr>
            @endforeach
          </tbody>
    </table>
</div>
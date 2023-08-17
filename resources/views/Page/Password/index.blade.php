<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@extends('Layout.main')
@section('content')
    <div class="row d-flex justify-content-center">
        <div class="p2 w-50">
            @if(session()->has('success'))
            <div class="error mb-3 bg-success text-light p-2 rounded">{{ session('success') }}</div>
            @endif
            <div class="mb-3">
                <h1 class="h3 mb-3">Ganti Password</h1>
            </div>
            <div class="row" id="read"></div>
            <form class="form-floating" action="/password/update" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    {{-- <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}"> --}}
                    <div class="form-floating">
                        <input type="password" name="old_password" id="old_password" class="form-control mb-2">
                        <label for="old_password">Password Lama</label>
                    </div>
                    @error('old_password')
                        <div class="error mb-3 bg-danger text-light p-2 rounded">{{ $message }}</div>
                    @enderror
                    @if(session()->has('error'))
                        <div class="error mb-3 bg-danger text-light p-2 rounded">{{ session('error') }}</div>
                    @endif
                    <div class="form-floating">
                        <input type="password" name="new_password" id="new_password" class="form-control mb-2">
                        <label for="new_password">Password Baru</label>
                    </div>
                    @error('new_password')
                        <div class="error mb-3 bg-danger text-light p-2 rounded">{{ $message }}</div>
                    @enderror
                    <div class="form-floating">
                        <input type="password" name="confirm_password" id="confirm_password" class="form-control mb-2">
                        <label for="confirm_password">Konfirmasi Password Baru</label>
                    </div>
                    @error('confirm_password')
                        <div class="error mb-3 bg-danger text-light p-2 rounded">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mt-2">
                    {{-- <button class="btn btn-success" onClick="/password/update">Simpan</button> --}}
                    <input type="submit" class="btn btn-success" value="Simpan">
                </div>
            </form>
        </div>
    </div>
@endsection
@extends('layouts.main')

@section('container')
<h2 class="display-6">{{ $title }}</h2>
<h4 class="">Add Employee</h4>
<div class="container">
    <div class="row">
        <div class="col-8">


            <form method="post" action="/employee">
                @csrf
                <div class="mb-2">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" autocomplete="off" class="form-control @error('name') is-invalid @enderror"
                        id="name" placeholder="Masukan Nama" name="name" value="{{old('name')}}">
                    @error('name')
                    <div id="validationServer03Feedback" class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-2">
                    <label for="number_id" class="form-label">Nomor ID</label>
                    <input type="text" autocomplete="off" class="form-control @error('number_id') is-invalid @enderror"
                        id="number_id" placeholder="Masukan Nomor ID" name="number_id" value="{{old('number_id')}}">
                    @error('number_id')
                    <div id="validationServer03Feedback" class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-2">
                    <label for="division" class="form-label">Bagian</label>
                    <input type="text" autocomplete="off" class="form-control @error('division') is-invalid @enderror"
                        id="division" placeholder="Masukan Bagian" name="division" value="{{old('division')}}">
                    @error('division')
                    <div id="validationServer03Feedback" class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Nomor HP</label>
                    <input type="text" autocomplete="off" class="form-control @error('phone') is-invalid @enderror"
                        id="phone" placeholder="Masukan Nomor HP" name="phone" value="{{old('phone')}}">
                    @error('phone')
                    <div id="validationServer03Feedback" class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Tambah Data!</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
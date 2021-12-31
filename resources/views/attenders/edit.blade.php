@extends('layouts.main')

@section('container')
<h2 class="display-6">{{ $title }}</h2>
<h4 class="">Edit Employee</h4>
<div class="container">
    <div class="row">
        <div class="col-8">


            <form method="post" action="/employee/{{ $employee->id}}">
                @method('patch')
                @csrf
                <div class="mb-2">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        placeholder="Masukan Nama" name="name" value="{{ $employee->name}}">
                    @error('name')
                    <div id="validationServer03Feedback" class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-2">
                    <label for="number_id" class="form-label">Nomor ID</label>
                    <input type="text" class="form-control @error('number_id') is-invalid @enderror" id="number_id"
                        placeholder="Masukan Nomor ID" name="number_id" value="{{ $employee->number_id}}">
                    @error('number_id')
                    <div id="validationServer03Feedback" class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-2">
                    <label for="division" class="form-label">Bagian</label>
                    <input type="text" class="form-control @error('division') is-invalid @enderror" id="division"
                        placeholder="Masukan Bagian" name="division" value="{{ $employee->division}}">
                    @error('division')
                    <div id="validationServer03Feedback" class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Nomor HP</label>
                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone"
                        placeholder="Masukan Nomor HP" name="phone" value="{{ $employee->phone}}">
                    @error('phone')
                    <div id="validationServer03Feedback" class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Update Data!</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
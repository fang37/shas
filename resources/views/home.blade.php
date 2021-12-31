@extends('layouts.main')

@section('container')
<h1 class="display-6">Halaman {{ $title }}</h1>

<div class="row">
    <div class="col-lg-5">
        <!-- small box -->
        <div class="box bg-info text-white">
            <h2 class="">8 orang</h2>
            <p>Sudah Hadir</p>
        </div>
    </div>
    <div class="btn btn-danger btn-xs">asd</div>
    <div class="col-lg-5">
        <div class="col-6 mb-3">
            <!-- small box -->
            <div class="small-box bg-success text-white">
                <h2 class="">8 orang</h2>
                <p>Sudah Hadir</p>
            </div>
        </div>
        <div class="col-6">
            <!-- small box -->
            <div class="small-box bg-warning text-white">
                <h2 class="">8 orang</h2>
                <p>Sudah Hadir</p>
            </div>
        </div>

    </div>


</div>


@endsection
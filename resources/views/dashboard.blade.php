@extends('layouts.main')

@section('container')
<h2 class="display-6">{{ $title }}</h2>

<div class="row">
    <div class="col-lg-5">
        <!-- small box -->
        <div class="bg-warning text-white p-3 rounded-3 mb-3">
            <div class="row">
                <div class="col-lg-3 ms-3 text-center">
                    <i class="display-1 bi-people-fill"></i>
                    <p>Kehadiran</p>
                </div>
                <div class="col d-flex align-items-center justify-content-center">
                    <h1 class="display-2">{{ $attender_counter }}</h1>
                    <h1 class="display-6">&nbsp;orang</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <!-- small box -->
                <div class="bg-primary text-white p-3 rounded-3">
                    <h2 class="display-4">{{ date('G:i',strtotime($time_work->start_at)) }}</h2>
                    <h4 class="">WIB</h4>
                    <p>Waktu Masuk</p>
                </div>
            </div>
            <div class="col-6">
                <!-- small box -->
                <div class="bg-danger text-white p-3 rounded-3">
                    <h2 class="display-4">{{ date('G:i',strtotime($time_work->end_at)) }}</h2>
                    <h4 class="">WIB</h4>
                    <p>Waktu Pulang</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="bg-success text-white p-3 rounded-3 mb-3">
            <div class="row">
                <div class="col-lg-3 ms-3 text-center">
                    <i class="display-1 bi-clock-fill"></i>
                    <p>Waktu</p>
                </div>
                <div class="col me-5 mt-2">
                    <div class="col d-flex align-items-center justify-content-center">
                        <div id="MyClockDisplay" class="clock display-2" onload="showTime()"></div>
                    </div>
                    <div class="col d-flex align-items-center justify-content-center">
                        <p>{{ $time_status }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-secondary text-white p-3 rounded-3 mb-3">
            <div class="row">
                <div class="col-lg-3 ms-3 text-center">
                    <i class="display-1 bi-calendar-fill"></i>
                    <p>Tanggal</p>
                </div>
                <div class="col d-flex align-items-center justify-content-center">
                    <div class="col">
                        <h2 class="display-6 mb-0">{{ date('l',time()) }}</h2>
                        <h2 class="display-3 mb-0">{{ date('d F',time()) }}</h2>
                        <h6 class="">{{ date('Y', time()) }}</h6>
                    </div>
                </div>
            </div>
        </div>



    </div>


</div>


@endsection
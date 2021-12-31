@include('partials.modal')
@extends('layouts.main')

@section('container')
<h2 class="display-6">{{ $title }} Page</h2>
{{-- <a href="/attendance/add" class="btn btn-sm btn-primary"><i class="bi-plus-circle"></i> Tambah Data</a> --}}
<div class="row justify-content-end d-flex align-items-end">
    <div class="col-sm-5 d-flex justify-content-start">
        <h6>Keterangan : </h6>
        @if ($current_date == request('date') || !(request('date')) )
        <h6 class="text-warning">&nbsp; <b>{{ $time_status }}</b></h6>
        <h6 class="text-danger">&nbsp; ({{ $current_day }}) </h6>
        @else
        <h6 class="text-secondary">&nbsp; <b>History {{ request('date') }}</b></h6>
        @endif
    </div>
    <div class="col mb-2">
        <div class="row d-flex justify-content-end text-right">
            <form action="/attendance" method="get">
                @if(request('attender'))
                <input type="hidden" name="attender" value="{{ request('attender') }}">
                @endif
                {{-- @if(request('author'))
                        <input type="hidden" name="author" value="{{ request('author') }}">
                @endif --}}
                <div class="input-group d-flex justify-content-end text-right">
                    <div class="col-sm-3">
                        <input id="datepicker" name="date" class="form-control" width="250" type="date"
                            max="{{ $current_date }}" value="{{ (request('date')) ?? old('date') ?? $current_date }}"
                            onchange="this.form.submit();" />
                    </div>
                    <div class="col-sm-5">
                        <input type="search" autocomplete="off" class="form-control" placeholder="Search..."
                            name="search" value="{{ request('search') }}">
                    </div>

                    <button class="btn btn-danger" type="submit"><i class="bi-search"></i></button>


                </div>
            </form>
        </div>
    </div>
</div>

<table class="table table-sm table-striped table-hover">
    <thead class="table-light">
        <tr class="table-dark text-center">
            <th scope="col">ID</th>
            <th scope="col">Nomor ID</th>
            <th scope="col">Nama</th>
            <th scope="col">Suhu</th>
            <th scope="col">Waktu Masuk</th>
            <th scope="col">Waktu Keluar</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    @foreach ($time_entries as $time_entry)
    <tbody>
        <tr>
            <th class="text-center" scope="row">
                {{ ($time_entries->currentpage()-1) * $time_entries ->perpage() + $loop->index + 1 }}</th>
            <td class="text-center">{{ $time_entry->attender->number_id }}</td>
            <td>{{ $time_entry->attender->name }}</td>
            @if($time_entry->temperature >= 37.0)
            <td class=" text-center table-danger">{{ $time_entry->temperature }}</td>
            @else
            <td class="text-center">{{ $time_entry->temperature }}</td>
            @endif
            <td class="text-center">{{ $time_entry->time_start }}</td>
            @if ($time_entry->time_end <> null)
                <td class="text-center">{{ $time_entry->time_end }}</td>
                @else
                <td class="text-center">
                    <a class="btn btn-xs btn-danger" href="/attendance/{{ $time_entry->id }}/edit"><i
                            class="bi-plus-circle"></i></a>
                </td>
                @endif
                <td class="text-center">
                    <a type="button" id="view" class="btn btn-xs btn-danger" data-bs-toggle="modal"
                        data-bs-target="#attendance-modal" data-name="{{ $time_entry->attender->name }}"
                        data-filepath="{{ $time_entry->file_path }}"
                        data-numberid="{{ $time_entry->attender->number_id }}"
                        data-timestart="{{ $time_entry->time_start }}" data-timeend="{{ $time_entry->time_end }}"
                        data-temp="{{ $time_entry->temperature }}">
                        <i class="bi-camera-fill"></i>
                    </a>
                </td>

        </tr>
    </tbody>


    @endforeach
</table>
<div class="d-flex justify-content-end">
    {{ $time_entries->links() }}
</div>




@endsection
@extends('layouts.main')

@section('container')
<h2>{{ $title }}</h2>
<h4 class="">Edit Attendance</h4>
<div class="container">
    <div class="row">
        <div class="col-8">


            <form method="post" action="/attendance/{{ $time_entry->id}}">
                @method('patch')
                @csrf
                <input type="hidden" class="form-control" id="attender_id" name="attender_id"
                    value="{{ $time_entry->attender_id }}">

                <div class="mb-2">
                    <label for="temperature" class="form-label">Suhu</label>
                    <input type="text" class="form-control @error('temperature') is-invalid @enderror" id="temperature"
                        placeholder="Masukan Suhu Badan" name="temperature"
                        value="{{ (old('temperature')) ?? $time_entry->temperature}}">
                    @error('temperature')
                    <div id="validationServer03Feedback" class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>

                <div class="mb-2">
                    <label for="time_start" class="form-label">Waktu Masuk</label>
                    <input id="datetimepicker" name="time_start" width="250" type="text" autocomplete="off"
                        class="form-control @error('time_start') is-invalid @enderror" id="time_start" name="time_start"
                        value="{{ (old('time_start')) ?? $time_entry->time_start}}">
                    @error('time_start')
                    <div id="validationServer03Feedback" class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>

                <div class="mb-2">
                    <label for="time_end" class="form-label">Waktu Keluar</label>
                    <input id="datetimepicker" name="time_end" width="250" type="text" autocomplete="off"
                        class="form-control @error('time_end') is-invalid @enderror" id="time_end" name="time_end"
                        value="{{ (old('time_end')) ?? $time_entry->time_end }}">
                    @error('time_end')
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
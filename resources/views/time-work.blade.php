@extends('layouts.main')

@section('container')
<h2 class="display-6">{{ $title }} Setting</h2>


<div class="col-8">
    <form method="post" action="/time-work/{{ $time_work->id}}">
        @method('patch')
        @csrf
        <div class="mb-2">
            <label for="start_at" class="form-label">Waktu Masuk</label>
            <input id="start_at" name="start_at" width="250" type="time" autocomplete="off"
                class="form-control @error('start_at') is-invalid @enderror" id="start_at" name="start_at"
                value="{{ (old('start_at')) ?? $time_work->start_at}}">
            @error('start_at')
            <div id="validationServer03Feedback" class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>

        <div class="mb-2">
            <label for="end_at" class="form-label">Waktu Keluar</label>
            <input id="start_at" name="end_at" width="250" type="time" autocomplete="off"
                class="form-control @error('end_at') is-invalid @enderror" id="end_at" name="end_at"
                value="{{ (old('end_at')) ?? $time_work->end_at }}">
            @error('end_at')
            <div id="validationServer03Feedback" class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Update Data!</button>
        </div>
    </form>
</div>

@endsection
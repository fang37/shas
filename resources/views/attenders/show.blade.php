@extends('layouts.main')

@section('container')
<h2 class="display-6">{{ $title }}</h2>

<div class="container row">

    <div class="card col d-flex justify-content-start" style="max-width: 35%">
        <div class="card-body">
            <h5 class="card-title">{{$employee->name}}</h5>
            <h6 class="card-subtitle mb-2 text-muted">{{$employee->number_id}}</h6>
            <p class="card-text">{{$employee->division}}</p>
            <p class="card-text"><i class="bi-telephone-fill"></i> {{$employee->phone}}</p>

            <a href="{{$employee->id}}/edit" class="btn btn-sm btn-primary"><i class="bi-pencil"></i> Edit</a>
            <form action="{{ route('employee.destroy', [$employee->id] )}}" method="post" class="d-inline">
                @method('delete')
                @csrf
                <button type="submit" class="btn btn-sm btn-danger delete-confirm" data-name="{{ $employee->name }}"><i
                        class="bi-trash"></i> Delete</button>
            </form>
            <a href="/employee" class="btn btn-sm btn-warning"><i class="bi-box-arrow-left"></i> Kembali</a>
        </div>
    </div>

    <div class="col d-flex justify-content-end" style="max-width: 65%">
        <table class="table table-sm table-striped table-hover mb-0">
            <thead class="table-light">
                <tr class="table-dark text-center">
                    <th scope="col" style="width:5%">Suhu</th>
                    <th scope="col" style="width:20%">Waktu Masuk</th>
                    <th scope="col" style="width:20%">Waktu Keluar</th>
                    <th scope="col" style="width:5%">Foto</th>
                </tr>
            </thead>
            @foreach ($time_entries as $time_entry)
            <tbody>
                <tr>
                    @if($time_entry->temperature >= 37.0)
                    <td class="text-center table-danger">{{ $time_entry->temperature }}</td>
                    @else
                    <td class="text-center">{{ $time_entry->temperature }}</td>
                    @endif
                    <td class="text-center">{{ $time_entry->time_start }}</td>
                    <td class="text-center">{{ $time_entry->time_end }}</td>
                    <td class="text-center">
                        <a type="button" id="view" class="btn btn-xs btn-danger" data-bs-toggle="modal"
                            data-bs-target="#attendance-modal" data-name="{{ $employee->name }}"
                            data-filepath="{{ $time_entry->file_path }}" data-numberid="{{ $employee->number_id }}"
                            data-timestart="{{ $time_entry->time_start }}" data-timeend="{{ $time_entry->time_end }}"
                            data-temp="{{ $time_entry->temperature }}">
                            <i class="bi-camera-fill"></i>
                        </a>
                    </td>
                </tr>
            </tbody>
            @endforeach
        </table>
    </div>
</div>
<div class="container row mt-2 mb-5">
    <div class="card col d-flex justify-content-start" style="max-width: 35%">
        <div class="card-body">
            <h5 class="card-title">Olah Kehadiran</h5>

            <form method="post" action="/attendance">
                @csrf
                <input type="hidden" class="form-control" id="attender_id" name="attender_id"
                    value="{{ $employee->id }}">

                <div class="mb-2">
                    <label for="temperature" class="form-label">Suhu</label>
                    <input type="text" class="form-control @error('temperature') is-invalid @enderror" id="temperature"
                        placeholder="Masukan Suhu Badan" name="temperature" value="{{old('temperature')}}">
                    @error('temperature')
                    <div id="validationServer03Feedback" class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>

                <div class="mb-2">
                    <label for="time_start" class="form-label">Waktu Masuk</label>
                    <input id="datetimepicker" name="time_start" width="250" type="text" autocomplete="off"
                        class="form-control @error('time_start') is-invalid @enderror" id="time_start" name="time_start"
                        value="{{old('time_start')}}">
                    @error('time_start')
                    <div id="validationServer03Feedback" class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>

                <div class="mb-2">
                    <label for="time_end" class="form-label">Waktu Keluar</label>
                    <input id="datetimepicker" name="time_end" width="250" type="text" autocomplete="off"
                        class="form-control @error('time_end') is-invalid @enderror" id="time_end" name="time_end"
                        value="{{old('time_end')}}">
                    @error('time_end')
                    <div id="validationServer03Feedback" class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-sm btn-success"><i class="bi-plus-circle"></i> Tambah</button>
                </div>
            </form>
            {{-- <form action="{{ route('employee.destroy', [$employee->id] )}}" method="post" class="d-inline">
            @method('delete')
            @csrf
            <button type="submit" class="btn btn-sm btn-danger delete-confirm" data-name="{{ $employee->name }}"><i
                    class="bi-trash"></i> Delete</button>
            </form> --}}
        </div>
    </div>
    <div class="col d-flex justify-content-end">
        {{ $time_entries->links() }}
    </div>
</div>


@endsection
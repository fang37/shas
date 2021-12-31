@extends('layouts.main')

@section('container')
<h2 class="display-6">{{ $title }}</h2>
<div class="row justify-content-end d-flex align-items-end">
    <div class="col-sm-5 d-flex justify-content-start">
        <a href="/employee/create" class="btn btn-sm btn-primary mb-2"><i class="bi-plus-circle"></i> Tambah Data</a>
    </div>
    <div class="col mb-2">
        <form action="/employee" method="get">
            @if(request('attender'))
            <input type="hidden" name="attender" value="{{ request('attender') }}">
            @endif
            {{-- @if(request('author'))
                    <input type="hidden" name="author" value="{{ request('author') }}">
            @endif --}}
            <div class="input-group">
                <input type="text" autocomplete="off" class="form-control" placeholder="Search..." name="search"
                    value="{{ request('search') }}">
                <button class="btn btn-danger" type="submit"><i class="bi-search"></i></button>
            </div>
        </form>
    </div>
</div>

<table class="table table-sm table-striped table-hover">
    <thead class="table-light">
        <tr class="table-dark text-center">
            <th scope="col" style="width:5%">ID</th>
            <th scope="col" style="width:10%">Nomor ID</th>
            <th scope="col" style="width:45%">Nama</th>
            <th scope="col" style="width:20%">Bagian</th>
            <th scope="col" style="width:20%">Action</th>
        </tr>
    </thead>
    @foreach ($employees as $employee)
    <tbody>
        <tr>
            <th class="text-center" scope="row">{{ $employee->id }}</th>
            <td class="text-center">{{ $employee->number_id }}</td>
            <td>{{ $employee->name }}</td>
            <td><i class="bi-edit"></i></td>
            <td class="text-center">
                <div class="text-center">
                    <a class="btn btn-xs btn-primary" href="/employee/{{ $employee->id }}"><i
                            class="bi-info-lg"></i></a>
                    <a class="btn btn-xs btn-warning" href="employee/{{ $employee->id }}/edit"><i
                            class="bi-pencil"></i></a>
                    <form action="{{ route('employee.destroy', [$employee->id] )}}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-xs btn-danger delete-confirm"
                            data-name="{{ $employee->name }}"><i class="bi-trash"></i></button>
                    </form>
                </div>

            </td>
        </tr>
    </tbody>
    @endforeach
</table>
<div class="d-flex justify-content-end">
    {{ $employees->links() }}
</div>
@endsection
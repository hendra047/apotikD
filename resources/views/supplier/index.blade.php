@extends('layout.conquer')

@section('content')
    <div class="portlet">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-reorder"></i>Daftar Supplier
            </div>
        </div>
        <div class="portlet-body">
            @if(session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Address</th>
                        <th>
                            <a href="{{ route('suppliers.create') }}" class="btn btn-primary">Tambah</a>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $d)
                        <tr>
                            <td>{{ $d->name }}</td>
                            <td>{{ $d->address }}</td>
                            <td>
                                <a href=""  class="btn btn-warning">Edit</a>
                                <a href=""  class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
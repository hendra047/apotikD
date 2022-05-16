@extends('layout.conquer')

@section('content')
  <h3 class="page-title">
    Daftar obat <small>daftar semua obat yang ada di apotik</small>
  </h3>
  <div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="index.html">Home</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="#">Medicine</a>
            <i class="fa fa-angle-right"></i>
        </li>
    </ul>
    <div class="page-toolbar">
        <!-- tempat action button -->

    </div>
  </div>

  <div class="container" style="width:100%">
    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div style="display: flex; align-items: end; justify-content: space-between;">
      <h2 class="w-auto" style="display: inline-block">Daftar Obat</h2>
      <a href="{{ route('medicines.create') }}" class="btn btn-primary">Tambah</a>
    </div>
    <table class="table">
      <thead>
        <tr>
          <th>Nama</th>
          <th>Bentuk</th>
          <th>Formula</th>
          <th>Kategori</th>
          <th>Foto</th>
          <th>Harga</th>
        </tr>
      </thead>
      <tbody>
        @foreach($result as $d)
        <tr>
          <td>{{ $d->generic_name }}</td>
          <td>{{ $d->form }}</td>
          <td>{{ $d->restriction_formula }}</td>
          <td>{{ $d->category->name }}</td>
          <td>
            <a href="#detail_{{$d->id}}" data-toggle="modal"><img src="{{asset('images/'.$d->image)}}" height="100px"/></a>
            <div class="modal fade" id="detail_{{$d->id}}" tabindex="-1" role="basic" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">{{ $d->generic_name }} {{ $d->form }}</h4>
                    </div>
                    <div class="modal-body">
                      <img src="{{ asset('images/'.$d->image) }}" height='300px'/>
                      <br>{{ $d->restriction_formula }}
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
              </div>
            </div>
          </td> 
          <td>{{ $d->price }}</td>
          <td>
            {{-- <a class='btn btn-info' href="{{route('medicines.show',$d->id)}}" --}} {{-- sama saja antar route() atau url() --}}
            <a class='btn btn-info' href="{{url('medicines/'.$d->id)}}"
               data-target="#show{{$d->id}}" data-toggle='modal'>
               detail
            </a>
            <a href="{{ url('medicines/'.$d->id.'/edit') }}"  class="btn btn-warning">Edit</a>

            <form method="POST" action="{{ url('medicines/'.$d->id) }}">
                @csrf
                @method('DELETE')
                <input type="submit" class="btn btn-danger" value="Delete"
                onclick="if(!confirm('Are you sure to delete this record ?')) return false;">
            </form>

            <div class="modal fade" id="show{{$d->id}}" tabindex="-1" role="basic" aria-hidden="true">
              <div class="modal-dialog">
               <div class="modal-content">
                 <!-- put animated gif here -->
                 <img src="{{ asset('assets/img/ajax-modal-loading.gif') }}" alt="" class="loading">
               </div>
              </div>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <div class="container">
      <h2>Daftar Obat</h2>
      <div class="row">
        @foreach($result as $d)
        <div class="col-md-3" style="text-align: center; border: 1px solid #999; margin: 10px; padding: 10px; border-radius: 10px;">
          <img src="{{asset('images/'.$d->image)}}" height="120px"/>
          <br>
          <a href="/medicines/{{ $d->id }}" target="_blank">
            <b>{{ $d->generic_name }}</b><br>
            {{ $d->form }}
          </a>
        </div>
        @endforeach
      </div>
    </div>
  </div>
@endsection
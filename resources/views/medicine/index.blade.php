@extends('layout.conquer')

@section('content')
<div class="container">
  <h2>Daftar Obat</h2>
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
          <img src="{{asset('images/'.$d->image)}}" height="100px"/>
        </td> 
        <td>{{ $d->price }}</td>
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
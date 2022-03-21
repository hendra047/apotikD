@extends('layout.conquer')

@section('content')

<div class="portlet">
  <div class="portlet-title">
    <div class="caption">
      <i class="fa fa-reorder"></i>Obat Termahal
    </div>
  </div>
  <div class="portlet-body">
    <table class="table">
      <thead>
        <tr>
          <th>Kategori</th>
          <th>Obat</th>
          <th>Harga</th>
        </tr>
      </thead>
      <tbody>
        @foreach($result as $data)
        <tr>
          <td>{{ $data->category_name }}</td>
          <td>{{ $data->generic_name }}</td>
          <td>{{ $data->highest_price }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
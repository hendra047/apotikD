@extends('layout.conquer')

@section('content')

<div class="portlet">
  <div class="portlet-title">
    <div class="caption">
      <i class="fa fa-reorder"></i>Daftar Kategori
    </div>
  </div>
  <div class="portlet-body">
    <table class="table">
      <thead>
        <tr>
          <th>Nama</th>
          <th>Description</th>
        </tr>
      </thead>
      <tbody>
        @foreach($result as $data)
        <tr>
          <td>{{ $data->name }}</td>
          <td>{{ $data->description }}</td>
        </tr>
        <tr>
          <td colspan="2">
            <div class="row">
              @foreach ($data->medicines as $m)
              <div class="col-md-3" style="text-align: center; border: 1px solid #999; margin: 10px; padding: 10px; border-radius: 10px;">
                <img src="{{asset('images/'.$m->image)}}" height="120px"/>
                <br>
                <b>{{ $m->generic_name }}</b><br>
                {{ $m->form }}
              </div>
              @endforeach
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
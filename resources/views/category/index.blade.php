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
          <td>
            <a class='btn btn-xs btn-info' data-toggle='modal' data-target='#myModal' onclick='showProducts({{ $data->id }})'>
              Detail
            </a>
        </td>
        </tr>
        {{-- <tr>
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

              <a class='btn btn-xs btn-info' data-toggle='modal' data-target='#myModal' onclick='showProducts({{ $data->id }})'>
                Detail
              </a>
            </div>
          </td>
        </tr> --}}
        @endforeach
      </tbody>
    </table>

    <div class="modal fade" id="myModal" tabindex="-1" role="basic" aria-hidden="true">
      <div class="modal-dialog modal-wide">
         <div class="modal-content" >
            <!--loading animated gif can put here-->
            <div class="modal-header">
                <h4 class="modal-title"><b>Detail Obat</b></h4>
            </div>
            <div class="modal-body" id="showproducts">
              <img src="{{ asset('assets/img/ajax-modal-loading.gif') }}" alt="" class="loading">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
         </div>
      </div>
    </div>    
  </div>
</div>
@endsection

@section('javascript')
  <script>
    function showProducts(category_id)
    {
      $.ajax({
        type:'GET',
        url:'{{ url("report/listmedicine/") }}' + "/" + category_id,
        data:{'_token':'<?php echo csrf_token() ?>',
              'category_id':category_id
            },
        success: function(data){
          $('#showproducts').html(data)
        }
      });
    }
  </script>
@endsection
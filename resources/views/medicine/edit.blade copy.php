@extends('layout.conquer')

@section('content')
<div class="container" style="width: 100%">
  <h2>Edit Supplier</h2>
  <div class="portlet">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-reorder"></i> Isikan data supplier
            </div>
            <div class="tools">
                <a href="" class="collapse"></a>
            </div>
        </div>
        <div class="portlet-body form">
            <form role="form" method="POST" action = "{{ url('suppliers/'.$data->id) }}">
                @csrf
                @method('PUT')
                <div class="form-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" class="form-control" name="name" value="{{ $data->name }}" placeholder="isikan nama supplier">
                        <span class="help-block">
                        *tulis nama lengkap perusahaan </span>
                    </div>
                    
                    <div class="form-group">
                        <label>Address</label>
                        <textarea class="form-control" rows="3" name="address">{{ $data->address }}</textarea>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-info">Submit</button>
                    <a href="{{ route('suppliers.index') }}" class="btn btn-default" >Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
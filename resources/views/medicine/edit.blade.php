@extends('layout.conquer')

@section('content')
<div class="container">
  <h2>Edit Medicine </h2>
  <div class="portlet">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-reorder"></i> Isikan data medicine
            </div>
            <div class="tools">
                <a href="" class="collapse"></a>
            </div>
        </div>
        <div class="portlet-body form">
            <form role="form" method="POST" action = "{{ url('medicines/'.$data->id) }}">
                @csrf
                @method('PUT')
                <div class="form-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Generic Name</label>
                        <input type="text" class="form-control" name="generic_name" value="{{ $data->generic_name }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Form</label>
                        <input type="text" class="form-control" name="form" value="{{ $data->form }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Restriction Formula</label>
                        <input type="text" class="form-control" name="restriction_formula" value="{{ $data->restriction_formula }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Price</label>
                        <input type="text" class="form-control" name="price" value="{{ $data->price }}">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" rows="3" name="description">{{ $data->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" class="form-control" name="faskes1" {{ ($data->faskes1 == 1) ? 'checked' : '' }}>
                        <label for="exampleInputEmail1">Faskes 1</label>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" class="form-control" name="faskes2" {{ ($data->faskes2 == 1) ? 'checked' : '' }}>
                        <label for="exampleInputEmail1">Faskes 2</label>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" class="form-control" name="faskes3" {{ ($data->faskes3 == 1) ? 'checked' : '' }}>
                        <label for="exampleInputEmail1">Faskes 3</label>
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <select class="form-control" name="category_id" id="">
                            <option value="">-pilih-</option>
                            @foreach($categories as $cat)
                                @if($cat->id == $data->category_id)
                                    <option value="{{ $cat->id }}" selected>{{ $cat->name }}</option>
                                @else
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="faskes3">Image</label>
                        <input type="file" class="form-control" name="image">
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-info">Submit</button>
                    <a href="{{ route('medicines.index') }}" class="btn btn-default" >Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
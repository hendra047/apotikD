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

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
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
        <tr id="tr_{{ $d->id }}">
          <td id="td_generic_name_{{ $d->id }}">{{ $d->generic_name }}</td>
          <td id="td_form_{{ $d->id }}">{{ $d->form }}</td>
          <td id="td_restriction_formula_{{ $d->id }}">{{ $d->restriction_formula }}</td>
          <td id="td_category_name_{{ $d->id }}">{{ $d->category->name }}</td>
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
          <td id="td_price_{{ $d->id }}">{{ $d->price }}</td>
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
          <td>
            <a href='#modalEdit' data-toggle='modal' onclick="getEditForm({{ $d->id }})" class="btn btn-warning">Edit 2A</a>
            <a href='#modalEdit' data-toggle='modal' onclick='getEditForm2({{ $d->id }})' class="btn btn-warning">Edit 2B</a>
            <a onclick="if(confirm('Apakah anda yakin menghapus data {{ $d->name }} ?')) deleteDataRemoveTR({{ $d->id }})" class="btn btn-danger">Delete 2</a>
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

  <div class="modal fade" id="modalCreate" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" >
            <form role="form" method="POST" action = "{{ url('suppliers') }}">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close"
                    data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Add New Medicine</h4>
                </div>
                <div class="modal-body">
                  <div class="form-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Generic Name</label>
                        <input type="text" class="form-control" name="generic_name" value="{{ $d->generic_name }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Form</label>
                        <input type="text" class="form-control" name="form" value="{{ $d->form }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Restriction Formula</label>
                        <input type="text" class="form-control" name="restriction_formula" value="{{ $d->restriction_formula }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Price</label>
                        <input type="text" class="form-control" name="price" value="{{ $d->price }}">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" rows="3" name="description">{{ $d->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" class="form-control" name="faskes1" {{ ($d->faskes1 == 1) ? 'checked' : '' }}>
                        <label for="exampleInputEmail1">Faskes 1</label>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" class="form-control" name="faskes2" {{ ($d->faskes2 == 1) ? 'checked' : '' }}>
                        <label for="exampleInputEmail1">Faskes 2</label>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" class="form-control" name="faskes3" {{ ($d->faskes3 == 1) ? 'checked' : '' }}>
                        <label for="exampleInputEmail1">Faskes 3</label>
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <select class="form-control" name="category_id" id="">
                            <option value="">-pilih-</option>
                            @foreach($categories as $cat)
                                @if($cat->id == $d->category_id)
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
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info">Submit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
  </div>

  <div class="modal fade" id="modalEdit" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id="modalContent">
                <div class="modal-header">
                    <button type="button" class="close"
                    data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Edit Medicine</h4>
                </div>
                <div class="modal-body">
                    <img src="{{ asset('images/preloader.gif') }}" class="loading" style="width: 100%">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info">Submit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
  </div>
@endsection

@section('javascript')
    <script>
        function getEditForm(id) {
            $.ajax({
                type:'POST',
                url:'{{route("medicines.getEditForm")}}',
                data: {
                    '_token': '<?php echo csrf_token() ?>',
                    'id': id
                },
                success:function(data){
                    $("#modalContent").html(data.msg);
                }
            });
        }

        function deleteDataRemoveTR(id)
        {
            $.ajax({
                type:'POST',
                url:'{{route("medicines.deleteData")}}',
                data: {
                    '_token': '<?php echo csrf_token() ?>',
                    'id': id
                },
                success:function(data){
                    if(data.status == 'ok')
                    {
                        alert(data.msg);
                        $('#tr_'+id).remove();
                    }
                }
            });
        }

        function getEditForm2(id)
        {
            $.ajax({
                type:'POST',
                url:'{{route("medicines.getEditForm2")}}',
                data:{
                      '_token': '<?php echo csrf_token() ?>',
                      'id':id
                    },
                success:function(data) {
                    $("#modalContent").html(data.msg);
                }
            });
        }

        function saveDataUpdateTD(id)
        {
            var eGenericName = $('#eGenericName').val();
            var eForm = $('#eForm').val();
            var eRestrictionFormula = $('#eRestrictionFormula').val();
            var ePrice = $('#ePrice').val();
            var eDescription = $('#eDescription').val();
            var eFaskes1 = $('#eFaskes1').val();
            var eFaskes2 = $('#eFaskes2').val();
            var eFaskes3 = $('#eFaskes3').val();
            var eCategoryId = $('#eCategoryId option:selected').val();
            var eCategoryName = $('#eCategoryId option:selected').text();

            $.ajax({
                type:'POST',
                url:'{{route("medicines.saveData")}}',
                data:{
                      '_token': '<?php echo csrf_token() ?>',
                      'id':id,
                      'generic_name':eGenericName,
                      'form':eForm,
                      'restriction_formula':eRestrictionFormula,
                      'price':ePrice,
                      'description':eDescription,
                      'faskes1':eFaskes1,
                      'faskes2':eFaskes2,
                      'faskes3':eFaskes3,
                      'category_id':eCategoryId,
                    },
                success:function(data) {
                    if(data.status == 'ok')
                    {
                        alert(data.msg);
                        $('#td_generic_name_'+id).html(eGenericName);
                        $('#td_form_'+id).html(eForm);
                        $('#td_restriction_formula_'+id).html(eRestrictionFormula);
                        $('#td_price_'+id).html(ePrice);
                        $('#td_category_name_'+id).html(eCategoryName);
                    }
                }
            });
        }
    </script>
@endsection
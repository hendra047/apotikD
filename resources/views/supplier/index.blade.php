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

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
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
                        <th>
                            <a href='#modalCreate' data-toggle='modal' class="btn btn-info">Tambah 2</a>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $d)
                        <tr id="tr_{{ $d->id }}">
                            <td id="td_name_{{ $d->id }}">{{ $d->name }}</td>
                            <td id="td_address_{{ $d->id }}">{{ $d->address }}</td>
                            <td>
                                <a href="{{ url('suppliers/'.$d->id.'/edit') }}"  class="btn btn-warning">Edit</a>

                                <form method="POST" action="{{ url('suppliers/'.$d->id) }}" style="display: inline !important">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" class="btn btn-danger" value="Delete"
                                    onclick="if(!confirm('Are you sure to delete this record ?')) return false;">
                                </form>
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
                        <h4 class="modal-title">Add New Supplier</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" class="form-control" name="name" placeholder="isikan nama supplier">
                                <span class="help-block">
                                *tulis nama lengkap perusahaan </span>
                            </div>

                            <div class="form-group">
                                <label>Address</label>
                                <textarea class="form-control" rows="3" name="address"></textarea>
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
                        <h4 class="modal-title">Edit Supplier</h4>
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
                url:'{{route("suppliers.getEditForm")}}',
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
                url:'{{route("suppliers.deleteData")}}',
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
                url:'{{route("suppliers.getEditForm2")}}',
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
            var eName = $('#eName').val();
            var eAddress = $('#eAddress').val();
            $.ajax({
                type:'POST',
                url:'{{route("suppliers.saveData")}}',
                data:{
                      '_token': '<?php echo csrf_token() ?>',
                      'id':id,
                      'name':eName,
                      'address':eAddress
                    },
                success:function(data) {
                    if(data.status == 'ok')
                    {
                        alert(data.msg);
                        $('#td_name_'+id).html(eName);
                        $('#td_address_'+id).html(eAddress);
                    }
                }
            });
        }
    </script>
@endsection

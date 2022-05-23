<form role="form" method="POST" action = "{{ url('suppliers/'.$data->id) }}">
    @csrf
    @method('PUT')
    <div class="modal-header">
        <button type="button" class="close"
        data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Edit Supplier</h4>
    </div>
    <div class="modal-body">
        <div class="form-body">
            <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input type="text" class="form-control" id="eName" name="name" placeholder="isikan nama supplier" value="{{ $data->name }}">
                <span class="help-block">
                *tulis nama lengkap perusahaan </span>
            </div>

            <div class="form-group">
                <label>Address</label>
                <textarea class="form-control" rows="3" id="eAddress" name="address">{{ $data->address }}</textarea>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-info"
        data-dismiss="modal"
        onclick="saveDataUpdateTD({{$data->id}})">Submit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
</form>

<div class="modal-header">
  <h4 class="modal-title">Data Obat</h4>
</div>
<div class="modal-body">
  <table class="table">
    <thead>
      <tr>
        <th>Data</th>
        <th>Isi</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Nama</td>
        <td>{{ $data->generic_name }}</td>
      </tr>
      <tr>
        <td>Bentuk</td>
        <td>{{ $data->form }}</td>
      </tr>
      <tr>
        <td>Formula</td>
        <td>{{ $data->restriction_formula }}</td>
      </tr>
      <tr>
        <td>Kategori</td>
        <td>{{ $data->category->name }}</td>
      </tr>    
      <tr>
        <td>Foto</td>
        <td>
          <img src="{{asset('images/'.$data->image)}}" height="100px"/>
        </td>
      </tr>
      <tr>
        <td>Harga</td>
        <td>{{ $data->price }}</td>
      </tr>
    </tbody>
  </table>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
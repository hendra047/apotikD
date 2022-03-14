<!DOCTYPE html>
<html lang="en">
<head>
  <title>Toko Obat</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Daftar Category Obat</h2>
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

</body>
</html>
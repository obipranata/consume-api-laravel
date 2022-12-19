@extends('frontend.templates')

@section('content')
<div class="container mt-5">
  <a href="{{route('add')}}" class="btn btn-success btn-sm mb-3">Tambah Pengguna</a>
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>Nama</th>
        <th>Email</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody id="tabel-pengguna">
    </tbody>
  </table>
</div>
<script src="https://code.jquery.com/jquery-3.6.2.min.js" integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script>

  $.ajax({
    url: "http://localhost:8000/api/pengguna",
    method: "get",
    dataType: "json",
    success : response => {
      let listPengguna = response.data
      let html = ""
      for (let pengguna of listPengguna){
        html += `
          <tr>
            <td>${pengguna.nama}</td>
            <td>${pengguna.email}</td>
            <td>
              <a class="btn btn-info btn-sm" href="http://localhost:8000/detail/${pengguna.id}">Detail</a>
              <button class="btn btn-danger btn-sm" onclick="deletePengguna(${pengguna.id})">Hapus</button>
            </td>
          </tr>
        `
      }
      $("#tabel-pengguna").append(html)
    }
  });

  function deletePengguna(id){
    $.ajax({
      url : `http://localhost:8000/api/pengguna/${id}/delete`,
      method: "POST",
      dataType: "json",
      success: _ => {
        window.location.href = ""
      }
    })
  }

</script>
@endsection
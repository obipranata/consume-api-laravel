@extends('frontend.templates')

@section('content')
<div class="container mt-5">
  <a href="/" class="btn btn-success mb-3">List</a>
  @if ($message = Session::get('success'))
    <div class="alert alert-success" role="alert" style="width: 60%">
      <strong>{{ $message }}</strong>
    </div>
  @endif
  <div class="card" style="width: 60%">
    <h5 class="card-header">Update User </h5>
    <div class="card-body">
      {{-- <form method="post" action=""> --}}
        <div class="mb-3">
          <label for="nama" class="form-label">Nama</label>
          <input type="text" class="form-control" id="nama" name="nama" value="">
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" name="email" value="">
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" value="">
        </div>
        <button id="submit" onclick="update()" class="btn btn-primary">Simpan</button>
      {{-- </form> --}}
    </div>
  </div>
</div>

<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://code.jquery.com/jquery-3.6.2.min.js" integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script>
  lastSegment = window.location.href.substr(window.location.href.lastIndexOf('/') + 1);
  $.ajax({
    url: "http://localhost:8000/api/pengguna/"+lastSegment,
    method: "get",
    dataType: "json",
    success : response => {
      let pengguna = response.data
      console.log(response)
      $("#nama").val(pengguna.nama)
      $("#email").val(pengguna.email)
    }
  });


  // function update(){
  //   $.ajax({
  //     url: "http://localhost:8000/api/pengguna/"+lastSegment+"/edit",
  //     method: "POST",
  //     cache: false,
  //     data:{
  //       nama: $('#nama').val(),
  //       email: $('#email').val(),
  //       password: $('#password').val(),
  //     },
  //     success: _ =>{
  //       window.location.href = "http://localhost:8000/"
  //     }
  //   });
  // }
  function update(){
    let nama = $("#nama").val()
    let email = $("#email").val()
    let password = $("#password").val()

    let fd = new FormData();
    fd.append("nama", nama);
    fd.append("email", email);

    if (password !== "")  fd.append("password", password);
      $.ajax({
        url : "http://localhost:8000/api/pengguna/"+lastSegment+"/edit",
        method: "POST",
        data: fd,
        processData:false,
        contentType:false,
        success: _ =>{
          window.location.href = "http://localhost:8000/"
        }
      })
    }
</script>
@endsection
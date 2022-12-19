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
    <h5 class="card-header">Add User</h5>
    <div class="card-body">
        <div class="mb-3">
          <label for="nama" class="form-label">Nama</label>
          <input type="text" class="form-control" id="nama" >
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" >
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" >
        </div>
        <button onclick="add()" id="submit" class="btn btn-primary">Simpan</button>
    </div>
  </div>
</div>

<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://code.jquery.com/jquery-3.6.2.min.js" integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
-->
<script>
  function add(){
    // e.preventDefault()
    let nama = $("#nama").val()
    let email = $("#email").val()
    let password = $("#password").val()

    if(nama == "") return alert("Nama tidak boleh kosong")
    if(email == "") return alert("Email tidak boleh kosong")
    if(password == "") return alert("Password tidak boleh kosong")

    let fd = new FormData();

    fd.append("nama", nama);
    fd.append("email", email);
    fd.append("password", password);

    $.ajax({
      url : "http://localhost:8000/api/pengguna",
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
@extends('templates')

@section('content')
<div class="container mt-5">
  <a href="{{route('artikel.index')}}" class="btn btn-success mb-3">List</a>
  @if ($message = Session::get('success'))
    <div class="alert alert-success" role="alert" style="width: 80%">
      <strong>{{ $message }}</strong>
    </div>
  @endif
  <div class="card" style="width: 80%">
    <h5 class="card-header">Tambah Artikel</h5>
    <div class="card-body">
      <form method="post" action="{{route('artikel.create')}}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="judul" class="form-label">Judul</label>
          <input type="text" class="form-control" id="judul" name="judul">
        </div>
        <div class="mb-3">
          <label for="isi" class="form-label">Isi</label>
          <textarea id="editor" name="isi" rows="4" cols="50"></textarea>
        </div>
        <div class="mb-3">
          <label for="foto" class="form-label">Foto</label>
          <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </form>
    </div>
  </div>
</div>
@endsection
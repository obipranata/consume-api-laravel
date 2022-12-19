@extends('templates')

@section('content')
<div class="container mt-5">
  <a href="{{route('produk.list')}}" class="btn btn-success mb-3">List</a>
  @if ($message = Session::get('success'))
    <div class="alert alert-success" role="alert" style="width: 60%">
      <strong>{{ $message }}</strong>
    </div>
  @endif
  <div class="card" style="width: 60%">
    <h5 class="card-header">Update Produk</h5>
    <div class="card-body">
      <form method="post" action="{{route('produk.update', $produk->id)}}" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="mb-3">
          <label for="nama" class="form-label">Nama</label>
          <input type="text" class="form-control" id="nama" name="nama" value="{{$produk->nama}}">
        </div>
        <div class="mb-3">
          <label for="harga" class="form-label">Harga</label>
          <input type="number" class="form-control" id="harga" name="harga" value="{{$produk->harga}}">
        </div>
        <div class="mb-3">
          <label for="ukuran" class="form-label">Ukuran</label>
          <input type="text" class="form-control" id="ukuran" name="ukuran" value="{{$produk->ukuran}}">
        </div>
        <div class="mb-3">
          <label for="deskripsi" class="form-label">Deskripsi</label>
          <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="{{$produk->deskripsi}}">
        </div>
        <div class="mb-3">
          <label for="gambar" class="form-label">Gambar</label>
          <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </form>
    </div>
  </div>
</div>
@endsection
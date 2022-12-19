@extends('templates')

@section('content')
<div class="container mt-5">
  <a href="{{route('produk.store')}}" class="btn btn-success mb-3">Tambah Produk</a>
  <h2 class="text-center">Data Produk</h2>
  @if ($message = Session::get('success'))
    <div class="alert alert-success" role="alert" style="width: 60%">
      <strong>{{ $message }}</strong>
    </div>
  @endif
    <div class="row">
      @foreach ($produk as $p)
        <div class="col-lg-3 mb-4">
          <div class="card" >
            <img src="{{Storage::url($p->file)}}" class="card-img-top" alt="..." style="max-height: 500px">
            <div class="card-body">
              <h5 class="card-title">{{$p->nama}}</h5>
              <h6 class="card-subtitle mb-2 text-success">IDR. {{number_format($p->harga)}}</h6>
              <p class="card-text">{{$p->ukuran}}</p>
              <p class="card-text">{{$p->deskripsi}}</p>
              <a href="{{route('produk.detail', $p->id)}}" class="btn btn-primary">Detail</a>
              <a href="{{route('produk.destroy', $p->id)}}" class="btn btn-danger">Hapus</a>
            </div>
          </div>
        </div>
      @endforeach
    </div>
</div>
@endsection
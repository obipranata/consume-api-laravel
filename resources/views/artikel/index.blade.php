@extends('templates')

@section('content')
<div class="container mt-5">
  <a href="{{route('artikel.store')}}" class="btn btn-success mb-3">Tambah Artikel</a>
  <h2 class="text-center">Daftar Artikel</h2>
  @if ($message = Session::get('success'))
    <div class="alert alert-success" role="alert" style="width: 60%">
      <strong>{{ $message }}</strong>
    </div>
  @endif
  <div class="row">
    @foreach ($artikel as $a)
      <div class="col-lg-4 mb-3">
        <div class="card" style="width: 400px">
          <img src="{{Storage::url($a->foto)}}" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">{{$a->judul}}</h5>
            <p class="card-text mb-0">
              <?= Str::of($a->isi)->limit(60) ?>
            </p>
            <a href="{{route('artikel.show', $a->id)}}">Selengkapnya...</a> <br>
            <a href="{{route('artikel.edit', $a->id)}}" class="btn btn-warning mt-5">Edit</a>
            <a href="{{route('artikel.destroy', $a->id)}}" class="btn btn-danger mt-5">Hapus</a>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>
@endsection
@extends('layout.template')

@extends('title', 'Form Movie')

@section('content')
   {{-- Form Input Data Movie --}}
   <h1>Form Data Movie</h1>
<form action=" ">
<div class="mb-3 row">
  <label for="title" class="col-sm-2 col-form-label">Title</label>
  <div class="col-sm-10">
    <input type="text" readonly class="form-control-plaintext" id="title" value=" required>
  </div>
</div>

<div class="mb-3 row">
  <label for="title" class="col-sm-2 col-form-label">Sypnosis</label>
  <div class="col-sm-10">
    <textarea class="form-control" name="sypnosis" id="sypnosis" rows="10"></textarea>
  </div>
</div>
</form>

@endsection
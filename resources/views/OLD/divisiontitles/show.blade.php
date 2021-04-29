@extends('testLayout')

@section('content')

<style>
    .container {
      max-width: 450px;
    }
    .push-top {
      margin-top: 50px;
    }
</style>

<div class="card push-top">
  <div class="card-header">
    user Information:
  </div>

  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <div >
        <div class="form-group">
            @csrf
            @method('PATCH')
            <label for="name">name: {{ $mostdivision->name }}</label>
        </div>
          <div class="form-group">
              <label for="id">id: {{ $mostdivision->id }}</label>
          </div>
          <div class="form-group">
              <label for="wins">wins: {{ $mostdivision->wins }}</label>
          </div>

          <a href="{{ route('divisiontitles.index')}}" class="btn btn-block btn-danger">Return</a>
      </div>
  </div>
</div>
@endsection

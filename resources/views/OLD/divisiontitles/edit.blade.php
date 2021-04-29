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
    Edit & Update
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
      <form method="post" action="{{ route('divisiontitles.update', $mostdivision->id) }}">
          <div class="form-group">
              @csrf
              @method('PATCH')
              <label for="id">id</label>
              <input type="text" class="form-control" name="id" value="{{ $mostdivision->id }}"/>
          </div>
          <div class="form-group">
              <label for="name">name</label>
              <input type="text" class="form-control" name="name" value="{{ $mostdivision->name }}"/>
          </div>
          <div class="form-group">
              <label for="name">wins</label>
              <input type="text" class="form-control" name="wins" value="{{ $mostdivision->wins }}"/>
          </div>
          <button type="submit" class="btn btn-block btn-danger">Update most division titles </button>

      </form>
  </div>
</div>
@endsection

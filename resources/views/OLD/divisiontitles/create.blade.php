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
    Add most division titles
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
      <form method="post" action="{{ route('divisiontitles.store') }}">
        <div class="form-group">
            @csrf
            <label for="name">name</label>
            <input type="text" class="form-control" name="name"/>
        </div>
        <div class="form-group">

            <label for="name">wins</label>
            <input type="text" class="form-control" name="wins"/>
        </div>

          <button type="submit" class="btn btn-block btn-danger">Create most division titles </button>
      </form>
  </div>
</div>
@endsection

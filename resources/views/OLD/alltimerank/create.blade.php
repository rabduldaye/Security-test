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
    Add All Time Rankings
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
      <form method="post" action="{{ route('alltimerank.store') }}">
          <div class="form-group">
              @csrf
              <label for="name">Name</label>
              <input type="text" class="form-control" name="name"/>
          </div>
          <div class="form-group">
              <label for="points">Points</label>
              <input type="text" class="form-control" name="points"/>
          </div>
          <div class="form-group">
              <label for="rank">Rank</label>
              <input type="text" class="form-control" name="rank"/>
          </div>
          <button type="submit" class="btn btn-block btn-danger">Create All Time Rankings</button>
      </form>
  </div>
</div>
@endsection

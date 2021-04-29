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
      <form method="post" action="{{ route('alltimerank.update', $alltimerank->id) }}">
          <div class="form-group">
              @csrf
              @method('PATCH')
              <label for="name">name</label>
              <input type="text" class="form-control" name="name" value="{{ $alltimerank->name }}"/>
          </div>
          <div class="form-group">
              <label for="points">points</label>
              <input type="text" class="form-control" name="points" value="{{ $alltimerank->points }}"/>
          </div>
          <div class="form-group">
              <label for="rank">rank</label>
              <input type="text" class="form-control" name="rank" value="{{ $alltimerank->rank }}"/>
          </div>
          <button type="submit" class="btn btn-block btn-danger">Update All Time Rankings</button>
      </form>
  </div>
</div>
@endsection

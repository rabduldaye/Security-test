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
    Create a Game!
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
      <form method="post" action="{{ route('creategames.store') }}">
        <div class="form-group">
            @csrf
            <label for="gamename">gamename</label>
            <input type="text" class="form-control" name="gamename"/>
        </div>
        <div class="form-group">
            <label for="team1">Team 1</label>
            <input type="text" class="form-control" name="team1"/>
        </div>
        <div class="form-group">
            <label for="team2">Team 2</label>
            <input type="text" class="form-control" name="team2"/>
        </div>
        <div class="form-group">
            <label for="team1-score">Team1 Score</label>
            <input type="text" class="form-control" name="team1-score"/>
        </div>
        <div class="form-group">
            <label for="team2-score">Team2 Score</label>
            <input type="text" class="form-control" name="team2-score"/>
        </div>
       
          <button type="submit" class="btn btn-block btn-danger">Create Game!</button>
      </form>
  </div>
</div>
@endsection

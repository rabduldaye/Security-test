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
    Game info:
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
            <label for="id">id: {{ $games->id }}</label>
        </div>
          <div class="form-group">
              <label for="espnID">espnED: {{ $games->easpnID }}</label>
          </div>
          <label for="name">name: {{ $games->name }}</label>
          </div>
          <div class="form-group">
              <label for="team1">Team 1: {{ $games->team1 }}</label>
          </div>
          <div class="form-group">
              <label for="team2">Team 2: {{ $games->team2 }}</label>
          </div>
          <div class="form-group">
              <label for="team1_score">Team1-Score: {{ $games->team1_score }}</label>
          </div>
          <div class="form-group">
          <label for="team12_score">Team2-Score: {{ $games->team2_score }}</label>
          </div>
          <a href="{{ route('games.index')}}" class="btn btn-block btn-danger">Return</a>
      </div>
  </div>
</div>
@endsection

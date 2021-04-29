@extends('sitelayout')
@section('pagetitle',  ': Set Score')
@section('content')

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

<form method="post" action="{{ route('games.updatescore', $games->id) }}">     
@csrf
              @method('PATCH')     
  <table>

  <tr>
    <th>Set Score</th><th><a style="float: right" href="/games"><i class="material-icons">undo</i></a></th>
  </tr>
  <tr>
    <td colspan="2"><a href="https://www.espn.com/mens-college-basketball/game?gameId={{$games->id}}">{{ $games->name }} ({{$games->points }} Points)</a></td>
  </tr>
  <tr>
  <td>{{ $games->team1Name }} Score: </td><td><input type="text" class="textfield" name="team1_score" value="{{ $games->team1_score }}" /></td>
  </tr>
  <tr>
  <td>{{ $games->team2Name }} Score: </td><td><input type="text" class="textfield" name="team2_score" value="{{ $games->team2_score }}" /></td>
  </tr>
  <tr>
  <td colspan="2"><button type="submit" class="btn btn-block btn-danger">Edit Game</button></td>
  </tr>

  </table>
</form>
  
@endsection

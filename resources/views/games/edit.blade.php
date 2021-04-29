@extends('sitelayout')
@section('pagetitle',  ': Create Game')
@section('content')



<form method="post" action="{{ route('games.update', $games->id) }}">     
@csrf
              @method('PATCH')     
  <table>

  <tr>
    <th>Edit Game</th><th><a style="float: right" href="/games"><i class="material-icons">undo</i></a></th>
  </tr>
  <tr>
    <td><label for="espnID">ESPN ID:</label></td>
    <td><input type="text" class="textfield" name="espnID" value="{{ $games->espnID }}"/></td>
  </tr>
  <tr>
  <td><label for="name">Name:</label></td>
  <td><input type="text" class="textfield" value="{{ $games->name }}" name="name"/></td>
  </tr>
 
  <tr>
  <td><label for="team1Name">Team 1 Name:</label></td>
  <td>    <input type="text" class="textfield" name="team1Name" value="{{ $games->team1Name }}" /></td>
  </tr>
  <tr>
  <td><label for="team1">Team 1 ESPN ID:</label></td>
  <td>    <input type="text" class="textfield" name="team1" value="{{ $games->team1 }}"/></td>
  </tr>
  <tr>
  <td><label for="team2Name">Team 2 Name:</label></td>
  <td>     <input type="text" class="textfield" value="{{ $games->team2Name }}" name="team2Name"/></td>
  </tr>
  <tr>
  <td ><label for="team2">Team 2 ESPN ID:</label></td>
  <td>     <input type="text" class="textfield" name="team2" value="{{ $games->team2 }}"/></td>
  </tr>
  <tr>
  <td ><label for="points">Points:</label></td>
  <td>     <input type="text" class="textfield" name="points" value="{{ $games->points }}"/></td>
  </tr>
  <tr>
  <td ><label for="date">Date:</label></td>
  <td>       <input type="date" class="textfield" name="date" value="{{ $games->date }}"/></td>
  </tr>
  <tr>
  <td colspan="2"><button type="submit" class="btn btn-block btn-danger">Edit Game</button></td>
  </tr>

  </table>
</form>
  
@endsection

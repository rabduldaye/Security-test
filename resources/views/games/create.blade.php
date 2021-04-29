@extends('sitelayout')
@section('pagetitle', ': Create Game')
@section('content')

<form method="post" action="{{ route('games.store') }}"> @csrf
<table>

  <tr>
    <th>Create Game</th><th><a style="float: right" href="/games"><i class="material-icons">undo</i></a></th>
  </tr>
  <tr>
    <td><label for="espnID">ESPN ID:</label></td>
    <td><input type="number" class="textfield" name="espnID"/></td>
  </tr>
  <tr>
  <td><label for="name">Name:</label></td>
  <td><input type="text" class="textfield" name="name"/></td>
  </tr>

  <tr>
  <td><label for="team1Name">Team 1 Name:</label></td>
  <td>    <input type="text" class="textfield" name="team1Name"/></td>
  </tr>
  <tr>
  <td><label for="team1">Team 1 ESPN ID:</label></td>
  <td>    <input type="number" class="textfield" name="team1"/></td>
  </tr>
  <tr>
  <td><label for="team2Name">Team 2 Name:</label></td>
  <td>     <input type="text" class="textfield" name="team2Name"/></td>
  </tr>
  <tr>
  <td ><label for="team2">Team 2 ESPN ID:</label></td>
  <td>     <input type="number" class="textfield" name="team2"/></td>
  </tr>
  <tr>
  <td ><label for="points">Points:</label></td>
  <td>     <input type="number" class="textfield" name="points"/></td>
  </tr>
  <tr>
  <td ><label for="date">Date:</label></td>
  <td>       <input type="date" class="textfield" name="date"/></td>
  </tr>
  <tr>
  <td colspan="2"><button type="submit" class="btn btn-block btn-danger">Create Game</button></td>
  </tr>

  </table>


      </form>





@endsection

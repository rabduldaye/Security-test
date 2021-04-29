@extends('testLayout')

@section('content')

<style>
  .push-top {
    margin-top: 50px;
  }
</style>
<button type="button" onclick="window.location='{{ url('creategames/create') }}'">Add a Game</button>
<div class="push-top">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}
    </div><br />
  @endif
  <table class="table">
    <thead>
        <tr class="table-warning">
	  <td>Game Name</td>
          <td>espnid</td>
          <td>Team1</td>
          <td>Team2</td>
          <td>Team1-Score</td>
          <td>Team2-Score</td>

        </tr>
    </thead>
    <tbody>
        @foreach($creategames as $create_games)
        <tr>
            <td>{{$creategames->gamename}}</td>
            <td>{{$creategames->espnid}}</td>
            <td>{{$creategames->Team1}}</td>
            <td>{{$creategames->Team2}}</td>
            <td>{{$creategames->Team1-Score}}</td>
            <td>{{$creategames->Team2-Score}}</td>

            <td class="text-center">
                <a href="{{ route('create_games.edit', $create_games->espnid)}}" class="btn btn-primary btn-sm"">Edit</a>
                <form action="{{ route('create_games.destroy', $create_games->espnid)}}" method="post" style="display: inline-block">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm"" type="submit">Delete</button>
                  </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
@endsection

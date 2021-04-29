@extends('sitelayout')

@section('pagetitle', ': Games') 
@section('content')



  <table>

    <tr>
    
      @isadmin
      <th>Games (winners in yellow)</th><th>
                  
         <a style="float: right" href="{{ route('games.create') }}"><i class="material-icons">add</i></a></th>
      @else
      <th colspan="2">Games (winners in yellow) </th>
      @endisadmin
    
    
    
    
    </tr>
    
    
    @foreach($games as $game)
        <tr class="table-warning">
          @isadmin
            <td class="top" colspan="2">
              <a href="https://www.espn.com/mens-college-basketball/game?gameId={{$game->id}}">{{ $game->name }} ({{$game->points }} Points)</a>
              @inSeason
              <a style="padding-left: 10px" href="{{ route('games.edit', $game->id)}}" class="btn btn-primary btn-sm"><i class="material-icons">edit</i></a>
              <form action="{{ route('games.destroy', $game->id)}}" method="post">    
                  
                  
                  
                    @csrf
                    @method('DELETE')
                    <button class="pic" type="submit"><i class="material-icons">delete</i></button>
                  </form>
                  @else 
                    <a  href="/games/setscore/{{ $game->id }}" class="btn btn-primary btn-sm"><i class="material-icons">sports_score</i></a>
                  @endif
                
            
            
          @else
            <td colspan="2" class="top"><a class="center" href="https://www.espn.com/mens-college-basketball/game?gameId={{$game->id}}">{{ $game->name }} ({{$game->points }} Points)</a></td>
          @endisadmin


          
        </tr>
        


          

        <tr class="center">
            <td colspan="2">
              <div class="switch-field">
                <input onclick="countChecked()" disabled id="{{$game->team1}}" {{ ($game->team1_score > $game->team2_score) ? "checked" : "" }} type="radio" name="{{$game->espnID}}" value="{{ $game->team1 }}">
                <label for="{{$game->team1}}"><img class="left" src="https://a.espncdn.com/combiner/i?img=/i/teamlogos/ncaa/500/{{ $game->team1 }}.png&h=30&w=30"><span>{{ $game->team1Name }}{{ ($game->team1_score != 0 || $game->team1_score != 0) ? " (" . $game->team1_score . ")" : "" }}</span></label>
                <input onclick="countChecked()" disabled id="{{$game->team2}}" {{ ($game->team2_score > $game->team1_score) ? "checked" : "" }} type="radio" name="{{$game->espnID}}" value="{{ $game->team2 }}"><label for="{{$game->team2}}">{{ $game->team2Name }}{{ ($game->team1_score != 0 || $game->team1_score != 0) ? " (" . $game->team2_score . ")" : "" }}<img class="right" src="https://a.espncdn.com/combiner/i?img=/i/teamlogos/ncaa/500/{{ $game->team2 }}.png&h=30&w=30"></label>
              </div>
            </td>
          </tr>
        

          <tr class="table-warning">
            <td class="center bot mbold" >Date: {{ \Carbon\Carbon::parse($game->date)->format('F jS, Y')}}<p></td>
          </tr>
             
    @endforeach
      
        
      
    </form>
  </table> 
<div>
@endsection

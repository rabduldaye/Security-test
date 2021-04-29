@extends('sitelayout')
@section('pagetitle', ': Picks')
@section('content')

<script type="text/javascript">
  
  var checked = 0;
  var tocheck = @json($numGames);

  
  function countChecked() {

    var inputs = document.getElementById("form").elements;
    var count  = 0;
    for (var i = 0; i < inputs.length; i++) {
        if (inputs[i].type == 'radio' && inputs[i].checked) {
            count++;
        }
    }
    
    this.checked = count;

    if (this.checked != this.tocheck) {
      document.getElementById("displaytotal").innerHTML = "Save " + this.checked + " out of " + this.tocheck + " picks";
    } else {
      document.getElementById("displaytotal").innerHTML = "Save ALL picks";
    }


    
    //alert(this.checked); Save {{ $numGames }} Picks
  

  }

  window.onload = function() {
    countChecked();
  };
</script>


  <table border=0>

    <tr>
    <th colspan="2">Game Picks</th>
    </tr>


    @if (($locked) or (!$canedit))
    <!-- picks are locked in since the season is on OR the user cannot edit -->
    @foreach($games as $game)
    <!-- game pick title -->
    @if ($game->scoredflag != "no") 
      <tr >
        <td style="padding-top: 25px"><label class="label">{{ $game->name }} (+{{$game->score}})</label></td><td style="padding-top: 20px"><label class="label">{{ \Carbon\Carbon::parse($game->date)->format('F jS, Y')}}</label></td>
        
      </tr> 
    @else
      <tr >
        <td style="padding-top: 25px"><label class="label">{{ $game->name }} ({{$game->points}})</label></td><td style="padding-top: 20px"><label class="label">{{ \Carbon\Carbon::parse($game->date)->format('F jS, Y')}}</label></td>
        
      </tr> 
            
     @endif
     @if ($game->scoredflag != "no") 

     <tr><td colspan="2" style="text-align:center; "><table style="display: inline-block; padding: 0px; margin-top: -5px"><tr>
        <td><img  src="https://a.espncdn.com/combiner/i?img=/i/teamlogos/ncaa/500/{{ $game->team1 }}.png&h=30&w=30"></td>
        <td style="padding-left: 0px"><label class="label">{{ $game->team1Name }}</td>
        
        <td><label class="label">{{ $game->team1_score }}</td>
        @if ($game->selection == $game->team1)
        <td><label class="label"><i class="material-icons">arrow_back</i></label></td>
        @else
        <td><label class="label"><i class="material-icons">arrow_forward</i></label></td>
        @endif
        <td><label class="label">{{ $game->team2_score }}</td>

        <td style="padding-right: 0px"><label class="label">{{ $game->team2Name }}</td>
        <td><img  src="https://a.espncdn.com/combiner/i?img=/i/teamlogos/ncaa/500/{{ $game->team2 }}.png&h=30&w=30"></td>
   
    </tr></table>
    </td></tr>








      
    @else
      
    <tr><td colspan="2" style="text-align:center; "><table style="display: inline-block; padding: 0px; margin-top: -5px" ><tr>
        <td><img  src="https://a.espncdn.com/combiner/i?img=/i/teamlogos/ncaa/500/{{ $game->team1 }}.png&h=30&w=30"></td>
        <td style="padding-left: 0px"><label class="label">{{ $game->team1Name }}</td>

        @if ($game->selection == $game->team1)
        <td><label class="label"><i class="material-icons">arrow_back</i></label></td>
        @else
        <td><label class="label"><i class="material-icons">arrow_forward</i></label></td>
        @endif

        <td style="padding-right: 0px"><label class="label">{{ $game->team2Name }}</td>
        <td><img  src="https://a.espncdn.com/combiner/i?img=/i/teamlogos/ncaa/500/{{ $game->team2 }}.png&h=30&w=30"></td>
   
    </tr></table>
    </td></tr>
            
     @endif



    @endforeach









    @else
    <!-- the user can edit and the picks are ready to be picked -->
    <form method="post" action="{{ route('storepicks') }}" id="form">@csrf
    @foreach($games as $game)
        <tr class="table-warning">
          <td class="top"><a class="center" href="https://www.espn.com/mens-college-basketball/game?gameId={{$game->id}}">{{ $game->name }} ({{$game->points }} Points)</a></td>
        </tr>
        
          <tr>
            <td>
              <div class="switch-field">
                <input onclick="countChecked()"  id="{{$game->team1}}" {{ (!is_null($game->selection) && $game->selection == $game->team1) ? "checked" : "" }} type="radio" name="{{$game->espnID}}" value="{{ $game->team1 }}">
                <label for="{{$game->team1}}"><img class="left" src="https://a.espncdn.com/combiner/i?img=/i/teamlogos/ncaa/500/{{ $game->team1 }}.png&h=30&w=30"><span>{{ $game->team1Name }}</span></label>
                <input onclick="countChecked()" id="{{$game->team2}}" {{ (!is_null($game->selection) && $game->selection == $game->team2) ? "checked" : "" }} type="radio" name="{{$game->espnID}}" value="{{ $game->team2 }}"><label for="{{$game->team2}}">{{ $game->team2Name }}<img class="right" src="https://a.espncdn.com/combiner/i?img=/i/teamlogos/ncaa/500/{{ $game->team2 }}.png&h=30&w=30"></label>
              </div>
            </td>
          </tr>

          <tr class="table-warning">
            <td class="center bot mbold" >Date: {{ \Carbon\Carbon::parse($game->date)->format('F jS, Y')}}<p></td>
          </tr>
             
    @endforeach
      
      
        <tr>
          <td>
          
            
          
          <button type="submit" class="btn btn-block btn-danger" id="displaytotal" onload="countChecked();" >Save {{ $numGames }} Picks!</button></td>
        </tr>
      
        
      
    </form>
    @endif


   
  </table> 
<div>
@endsection

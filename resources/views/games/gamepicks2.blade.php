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
        <td colspan="2" ><label class="label">{{ $game->name }} (+{{$game->score}})</label></td>
        
      </tr> 
    @else
      <tr >
        <td colspan="2" ><label class="label">{{ $game->name }} ({{$game->points}})</label></td>
        
      </tr> 
            
     @endif
     @if ($game->scoredflag != "no") 

     <tr><td colspan="2" style="text-align:center; ">
        
          <div class="switch-field">
            <label class="left scored">
                <table style="background-color: inherit; color: inherit"><tr>
                  <td style="padding: 0px; padding-right: 10px"><img src="https://a.espncdn.com/combiner/i?img=/i/teamlogos/ncaa/500/{{ $game->team1 }}.png&h=30&w=30"></td>
                  <td style="padding: 0px">{{ $game->team1Name }}</td>
                  @if ($game->selection == $game->team1)
                    <td style="padding: 0px"><i style="vertical-align: middle; padding-left: 5px" class="material-icons">arrow_back_ios</i></td>
                  @endif
               </tr></table>          
          </label>
           <label class="score scored"><span >{{ $game->team1_score }}</span></label>
           <label class="score scored"><span >{{ $game->team2_score }}</span></label>
           <label class="right scored">
                <table style="background-color: inherit; color: inherit"><tr>
                @if ($game->selection == $game->team2)
                    <td style="padding: 0px"><i style="vertical-align: middle;padding-right: 5px" class="material-icons">arrow_forward_ios</i></td>
                  @endif  
                
                  <td style="padding: 0px">{{ $game->team2Name }}</td>
                  <td style="padding: 0px; padding-left: 10px"><img src="https://a.espncdn.com/combiner/i?img=/i/teamlogos/ncaa/500/{{ $game->team2 }}.png&h=30&w=30"></td>
                 
               </tr></table>          
          </label>

          
        </div>
     
     
     
    </td></tr>








      
    @else
      


    <tr><td colspan="2" style="text-align:center; ">
        
        <div class="switch-field">
          <label class="scored">
              <table style="background-color: inherit; color: inherit" ><tr>
                <td style="padding: 0px; padding-right: 10px"><img src="https://a.espncdn.com/combiner/i?img=/i/teamlogos/ncaa/500/{{ $game->team1 }}.png&h=30&w=30"></td>
                <td style="padding: 0px">{{ $game->team1Name }}</td>
                
             </tr></table>          
        </label>
        @if ($game->selection == $game->team1)
        <label class="score scored" style="padding: 12px 16px 12px 14px;text-align: center"><i class="material-icons">arrow_back</i></label>
        @else
        <label class="score scored" style="padding: 12px 16px 12px 14px; text-align: center"><i class="material-icons">arrow_forward</i></label>
        @endif
        
         <label class="scored">
              <table style="background-color: inherit; color: inherit"><tr>
             
              
                <td style="padding: 0px">{{ $game->team2Name }}</td>
                <td style="padding: 0px; padding-left: 10px"><img src="https://a.espncdn.com/combiner/i?img=/i/teamlogos/ncaa/500/{{ $game->team2 }}.png&h=30&w=30"></td>
               
             </tr></table>          
        </label>

        
      </div>
   
   
   
  </td></tr>
  <tr class="table-warning">
            <td colspan="2" class="center bot mbold" >Date: {{ \Carbon\Carbon::parse($game->date)->format('F jS, Y')}}<p></td>
          </tr>













            
     @endif



    @endforeach









    @else
    <!-- the user can edit and the picks are ready to be picked -->
    <form method="post" action="{{ route('storepicks') }}" id="form">@csrf
    <input type="hidden" name="id" value="{{$id}}">
    @foreach($games as $game)

    @if ($game->scoredflag != "no") 
      <tr >
        <td colspan="2" ><label class="label">{{ $game->name }} (+{{$game->score}})</label></td>
        
      </tr> 
    @else
      <tr >
        <td colspan="2" ><label class="label">{{ $game->name }} ({{$game->points}})</label></td>
        
      </tr> 
            
     @endif
     @if ($game->scoredflag != "no") 

<tr><td colspan="2" style="text-align:center; ">
   
     <div class="switch-field">
       <label class="left scored">
           <table style="background-color: inherit; color: inherit"><tr>
             <td style="padding: 0px; padding-right: 10px"><img src="https://a.espncdn.com/combiner/i?img=/i/teamlogos/ncaa/500/{{ $game->team1 }}.png&h=30&w=30"></td>
             <td style="padding: 0px">{{ $game->team1Name }}</td>
             @if ($game->selection == $game->team1)
               <td style="padding: 0px"><i style="vertical-align: middle; padding-left: 5px" class="material-icons">arrow_back_ios</i></td>
             @endif
          </tr></table>          
     </label>
      <label class="score scored"><span >{{ $game->team1_score }}</span></label>
      <label class="score scored"><span >{{ $game->team2_score }}</span></label>
      <label class="right scored">
           <table style="background-color: inherit; color: inherit"><tr>
           @if ($game->selection == $game->team2)
               <td style="padding: 0px"><i style="vertical-align: middle;padding-right: 5px" class="material-icons">arrow_forward_ios</i></td>
             @endif  
           
             <td style="padding: 0px">{{ $game->team2Name }}</td>
             <td style="padding: 0px; padding-left: 10px"><img src="https://a.espncdn.com/combiner/i?img=/i/teamlogos/ncaa/500/{{ $game->team2 }}.png&h=30&w=30"></td>
            
          </tr></table>          
     </label>

     
   </div>



</td></tr>


<tr class="table-warning">
            <td colspan="2" class="center bot mbold" >Date: {{ \Carbon\Carbon::parse($game->date)->format('F jS, Y')}}<p></td>
          </tr>





 
@else
        
          <tr>
            <td colspan="2">
              <div class="switch-field">
                <input onclick="countChecked()"  id="{{$game->team1}}" {{ (!is_null($game->selection) && $game->selection == $game->team1) ? "checked" : "" }} type="radio" name="{{$game->espnID}}" value="{{ $game->team1 }}">
                <label for="{{$game->team1}}"><img class="left" src="https://a.espncdn.com/combiner/i?img=/i/teamlogos/ncaa/500/{{ $game->team1 }}.png&h=30&w=30"><span>{{ $game->team1Name }}</span></label>
                <input onclick="countChecked()" id="{{$game->team2}}" {{ (!is_null($game->selection) && $game->selection == $game->team2) ? "checked" : "" }} type="radio" name="{{$game->espnID}}" value="{{ $game->team2 }}"><label for="{{$game->team2}}">{{ $game->team2Name }}<img class="right" src="https://a.espncdn.com/combiner/i?img=/i/teamlogos/ncaa/500/{{ $game->team2 }}.png&h=30&w=30"></label>
              </div>
            </td>
          </tr>

          <tr class="table-warning">
            <td colspan="2" class="center bot mbold" >Date: {{ \Carbon\Carbon::parse($game->date)->format('F jS, Y')}}<p></td>
          </tr>
             @endif
    @endforeach
      
      
        <tr>
          <td colspan="2">
          
            
          
          <button type="submit" class="btn btn-block btn-danger" id="displaytotal" onload="countChecked();" >Save {{ $numGames }} Picks!</button></td>
        </tr>
      
        
      
    </form>
    @endif


   
  </table> 
<div>
@endsection

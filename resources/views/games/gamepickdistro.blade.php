@extends('sitelayout')
@section('pagetitle', ': Pick Distribution')
@section('content')


  

    <table >
    <tr>
        <th colspan="2">Game Pick Distribution</th> 
    </tr>
    @foreach ($games as $game)
    <tr>
        <td ><label class="label">{{ $game->name }}</label></td><td ><label class="label">{{ \Carbon\Carbon::parse($game->date)->format('F jS, Y')}}</label></td>
        
    </tr>
    
    <tr>
        <td colspan="2" style="text-align:center;"><table  style="display: inline-block; padding: 0px; margin-top: -5px; margin-bottom: -7px" ><tr>
        <td style="padding-right: 0px;"><img   src="https://a.espncdn.com/combiner/i?img=/i/teamlogos/ncaa/500/{{ $game->team1 }}.png&h=30&w=30"></td>
        <td><label class="label">{{ $game->team1Name }}</td>
        <td><label class="label">VS</td>
        <td><label class="label">{{ $game->team2Name }}</td>
        <td style="padding-left: 0px;"><img  src="https://a.espncdn.com/combiner/i?img=/i/teamlogos/ncaa/500/{{ $game->team2 }}.png&h=30&w=30"></td>
        </tr></table></td>
   </tr>
   <tr><td colspan="2" style="margin-bottom: 10px">
   <div class="progress progress-stacked" style="margin-bottom: 50px; margin-top: -5px;">
        
        <span style="width: {{ ($game->selt1 / ($game->selt1 + $game->selt2))*100 }}%; background-color: red" class="bg-red" style=""> {{ ($game->selt1 / ($game->selt1 + $game->selt2))*100 }}%</span>
        <span style="width: {{ ($game->selt2 / ($game->selt1 + $game->selt2))*100 }}%; background-color: green" class="bg-blue" style="background-color:: blue"> {{ ($game->selt2 / ($game->selt1 + $game->selt2))*100 }}%</span>
        
    </div>
    

   </td></tr>
    @endforeach




  </table> 
<div>
@endsection

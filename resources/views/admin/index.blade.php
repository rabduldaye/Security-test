@extends('sitelayout')
@section('pagetitle', ': Admin') 
@section('content')


<div class="column">
  

<table class="lefthome">
    <tr>
        <th>Site Stats</th> 
    </tr>          
    <tr>
    <td>
        <label class="label">Users:</label> {{$usercount}}<p>
        <label class="label">Games:</label> {{$gamecount}}<p>
        <label class="label">Scored Games:</label> {{$scoredGames}}<p>
        <label class="label">Games Left:</label> {{$gamecount - $scoredGames}}<p>
        
        <label class="label">Picks:</label> {{$pickCount}}<p>
        <label class="label">Players:</label> {{$numPlayers}}<p>
        <label class="label">Players (short picks):</label> {{$numPlayersWithPicksShort}}<p>
   
    </td>
</table>
<p>    
 

<table class="lefthome">
    <tr>
        <th>Manage Site</th> 
    </tr>          
    <tr>
    <td>
        <a href="/config">Site Configuration</a><p>
        <a href="/config/edit">Edit Site Configuration</a><p> 
        <a href="/rules">Rules</a><p> 
        <a href="/config/rules">Edit Rules</a><p>

    </td>
</table>
<p>    
@if ($nogames)

<table class="lefthome">
    <tr>
        <th>No Games Scheduled</th> 
    </tr>          
    <tr>
    <td> &nbsp; </td>
    </tr>
</table>
<p>    
@else
<table class="lefthome" >
    <tr>
        <th colspan="2">Upcoming Games</th> 
    </tr>
    @foreach ($upcomingGames as $game)
    <tr>
        <td><label class="label">{{ $game->name }}</label></td><td><label class="label">{{ \Carbon\Carbon::parse($game->date)->format('F jS, Y')}}</label></td>
        
    </tr>
    
    <tr><td colspan="2" style="text-align:center;"><table style="display: inline-block; padding: 0px; margin-top: -5px" ><tr>
        <td><img  src="https://a.espncdn.com/combiner/i?img=/i/teamlogos/ncaa/500/{{ $game->team1 }}.png&h=30&w=30"></td>
        <td><label class="label">{{ $game->team1Name }}</td>
        <td><label class="label">VS</td>
        <td><label class="label">{{ $game->team2Name }}</td>
        <td><img  src="https://a.espncdn.com/combiner/i?img=/i/teamlogos/ncaa/500/{{ $game->team2 }}.png&h=30&w=30"></td>
   
    </tr></table>
    </td></tr>
    @endforeach
</table>

              
  
<p>    


@endif




</div>
<div class="column">

<table class="lefthome">
    <tr>
        <th>Manage Users</th> 
    </tr>          
    <tr>
    <td>
        <a href="/user">Manage Profiles</a><p>
        <a href="/tags">Set up Groups (Tags)</a><p> 
        <a href="{{ route('tags.usersorter')}}">Sort Users into Groups (Tags)</a><p> 

    </td>
</table>
<p>    

<table class="lefthome">
    <tr>
        <th>Recent Profile Changes:</th> 
    </tr>          
    @foreach($last3profileUpdates as $user) 
    <tr>
    <td><a href="/user/{{$user->id}}">{{ $user->firstname}} "{{ $user->nickname}}" {{ $user->lastname}}</a></td>
    </tr> 
    @endforeach




</table>
<p>    

<table class="lefthome">
    <tr>
        <th>Recent Picks:</th> 
    </tr>          
    @foreach($last3picksMade as $mypick) 
    <tr>
    <td><label class="label ">{{ $mypick->firstname}} "{{ $mypick->nickname}}" {{ $mypick->lastname}} Selected:</a> 
    @if ($mypick->selection == $mypick->team1)
    {{ $mypick->team1Name }}
    @else
    {{ $mypick->team2Name }}
    @endif
    in the {{ $mypick->name}}<p>
    
    </label>
    
    @endforeach




</table>
<p>    
</div>
<div class="column">

<table class="lefthome">
    <tr>
        <th>PreSeason Tasks</th> 
    </tr>          
    <tr>
    <td>
        <a class="tdlinks" href="{{ route('games.index')}}">Set up Games</a><p>
        <a class="tdlinks" href="{{ route('mail')}}">Send Invitations</a><p>
    </td>
</table>
<p>    
<table class="lefthome">
    <tr>
        <th>Season Start Tasks</th> 
    </tr>          
    <tr>
    <td>
    @if ($locked)
        <a href="{{ route('config.toggleSeason')}}">Set Season Off (unlocks picks)</a><p>
    @else
        <a href="{{ route('config.toggleSeason')}}">Set Season On (locks picks)</a><p>
    @endif
        
        <a href="{{ route('conference.index')}}">Set up Conferences</a><p>
        <a href="{{ route('division.index')}}">Set up Divisions</a><p>
        <a href="{{ route('user.usersorter')}}">Sort Users into Divisions @if($sortedUsers != 'no') (sorted) @endif</a><p>    
           
    </td>
</table>

<p>
   
<table class="lefthome">
    <tr>
        <th>Season Tasks</th> 
    </tr>          
    <tr>
    <td>
        <a href="{{ route('games.index')}}">Set Scores</a><p>
        <a href="{{ route('mail')}}">Send Updates</a><p>    
    </td>
</table>
<p>         
<table  class="lefthome">
    <tr>
        <th>Season End Tasks</th> 
    </tr>          
    <tr>
    <td>
        <a href="{{ route('conference.index')}}">Clear Season (Wipes games/picks/divisions/etc)</a><p>
        
    </td>
</table>
</div>
@endsection

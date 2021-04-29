@extends('sitelayout')
@section('pagetitle', ': Home') 
@section('content')


<div class="row">
@userssorted
<div class="column">
<table class="lefthome">
    <tr>
        <th>Your Scoreboard</th> 
    </tr>          
    <tr>
    <td>

        

        <label class="label">Your rankings with {{$gamestotal - $gamesplayed}} games remaining:</label><p>
        <label class="label">Points: {{ $yourpoints}}</label><p>
        @if($divTie) 
        <label class="label">Division:</label> You are tied for <label class="label">{{$divRank}}</label> place!<p>
        @else
        <label class="label">Division:</label> You are in <label class="label">{{$divRank}}</label> place!<p>
        @endif
        @if($confTie) 
        <label class="label">Conference:</label> You are tied for <label class="label">{{$confRank}}</label> place! <p>
        @else
        <label class="label">Conference:</label> You are in <label class="label">{{$confRank}}</label> place! <p>
        @endif
        @if($confTie) 
        <label class="label">League:</label> You are tied for <label class="label">{{$leagueRank}}</label> place!<p>
        @else
        <label class="label"> League:</label> You are in <label class="label">{{$leagueRank}}</label> place!<p>
        @endif
        
        
    </td>
</table>
<p>    




<table class="lefthome">
    <tr>
        <th colspan="3">League Leaders</th> 
    </tr>          
    <tr>
       <td><label class="label">Rank</label></td>
        <td><label class="label">Name</label></td>
        <td><label class="label">Score</label></td>
        
       </tr>
        @foreach ($leagueTopThree as $standing) 
        <tr>
            <td style="text-align:center">{{$standing->rank}}</td>
            <td><a href="/user/{{$standing->id}}">{{$standing->firstname}} "{{$standing->nickname}} " {{$standing->lastname}}</a></td>
            <td style="text-align:center">{{$standing->score}}
        <tr>
        @endforeach
    
</table>
<p>    

<table class="lefthome">
    <tr>
        <th colspan="3">Conference: {{ Auth::user()->conference}} Leaders</th> 
    </tr>          
    <tr>
       <td><label class="label">Rank</label></td>
        <td><label class="label">Name</label></td>
        <td><label class="label">Score</label></td>
        
       </tr>
        @foreach ($conferenceTopThree as $standing) 
        <tr>
            <td style="text-align:center">{{$standing->rank}}</td>
            <td><a href="/user/{{$standing->id}}">{{$standing->firstname}} "{{$standing->nickname}} " {{$standing->lastname}}</a></td>
            <td style="text-align:center">{{$standing->score}}
        <tr>
        @endforeach
    
</table>
<p>    


<table class="lefthome">
    <tr>
        <th colspan="3">Division: {{ Auth::user()->division}} Leaders</th> 
    </tr>          
    <tr>
       <td><label class="label">Rank</label></td>
        <td><label class="label">Name</label></td>
        <td><label class="label">Score</label></td>
        
       </tr>
        @foreach ($divisionTopThree as $standing) 
        <tr>
            <td style="text-align:center">{{$standing->rank}}</td>
            <td><a href="/user/{{$standing->id}}">{{$standing->firstname}} "{{$standing->nickname}} " {{$standing->lastname}}</a></td>
            <td style="text-align:center">{{$standing->score}}
        <tr>
        @endforeach
    
</table>
<p>    

</div>
@enduserssorted
<div class="column">
<!-- column two -->
<table class="lefthome">
    <tr>
        <th>Fun Stuff</th> 
    </tr>          
    <tr>
    <td>
        <a class="tdlinks" href="{{ route('user.index')}}">See other profiles</a><p>
        <a class="tdlinks" href="/map">User Map</a><p>
        <a class="tdlinks" href="{{ route('pickdistro')}}">Pick Distribution</a><p>
        
        @userssorted
        <a class="tdlinks" href="/games/scenariogenerator">Scenario Generator</a><p>
        @enduserssorted
        
    </td>
</table>
<p>    

<table class="lefthome">
    <tr>
        <th>Smack Talk: </th> 
    </tr>          
    <tr>
    <td><label class="label">{{$smackuser}} Says:</label><p>
    &nbsp; &nbsp; &nbsp; {{$smack}} 
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
<!-- column three -->
<table class="lefthome">
    <tr>
        <th>My Profile</th> 
    </tr>          
    <tr>
    <td>
        <a class="tdlinks" href="/user/{{ Auth::user()->id }}">My profile</a><p>
        <a  href="{{ route('user.edit', Auth::user()->id )}}">Update My Profile</a><p>
        <a  href="{{ route('user.editpwd', Auth::user()->id )}}">Change your password</a><p>
        
    </td>
</table>
<p>    
<table class="lefthome" >
    <tr>
        <th colspan="3">Your picks: </th> 
    </tr>          
    <tr>
        <td colspan="3"><label class="label">
            @if ($numGames == $countMyPicks)
                All {{$numGames}} picks saved!<p>
            @else
                Only {{ $countMyPicks }} of your picks have been saved.  You are missing {{ $numGames - $countMyPicks}} picks.<p>
            @endif
        </label></td>
    </tr>
    @foreach ($mypicks as $mypick)
    <tr>
        <!-- game pick title -->
        @if ($mypick->scoredflag != "no") 
            
            <td colspan="3" style="padding-top: 20px"><label class="label">{{$mypick->name}} (+{{$mypick->score}})  </label></td>
            
           
        
        
        @else
            <td colspan="3" style="padding-top: 20px"><label class="label">{{$mypick->name}} ({{$mypick->points}})</label></td>
        @endif
    </tr>
    <tr >
       
        @if ($mypick->selection == $mypick->team1)
        
        <td>
        <table></tr>
        <td><label class="label "><i class="material-icons">arrow_forward</i></label></td>
        <td style="padding-right: 0px;"><img  src="https://a.espncdn.com/combiner/i?img=/i/teamlogos/ncaa/500/{{ $mypick->team1 }}.png&h=30&w=30"></td>
        <td><label class="label">{{ $mypick->team1Name }}</td>
        <td >
        @if ($mypick->scoredflag != "no") 
            @if ($mypick->score == 0)
            <i style="color:red" class="material-icons">close</i>
            @else
            <i style="color:green" class="material-icons">done</i>
            @endif
        @else
            &nbsp;
        @endif    
        
        </td>
        </tr></table>

        </td>
        @else
        <td>
        <table ></tr>
        <td><label class="label"><i class="material-icons">arrow_forward</i></label></td>
        <td style="padding-right: 0px; "><img  src="https://a.espncdn.com/combiner/i?img=/i/teamlogos/ncaa/500/{{ $mypick->team2 }}.png&h=30&w=30"></td>
        <td><label class="label">{{ $mypick->team2Name }}</td>
        <td >
        @if ($mypick->scoredflag != "no") 
            @if ($mypick->score == 0)
            <i style="color: red" class="material-icons">close</i>
            @else
            <i style="color: green" class="material-icons">done</i>
            @endif
        @else
            &nbsp;
        @endif    
        
        </td>
        </tr></table>

        </td>
        @endif
        
    </tr>
    @endforeach
        
</table>
<p>    







</div></div>


@endsection
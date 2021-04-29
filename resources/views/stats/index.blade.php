@extends('sitelayout')
@section('title', 'Nolan Bowl: All Time Scores')
@section('content')

<a href="/stats" class=" brl intbtn-group-button">All Time Scores</A><a href="/stats/nbi" class="intbtn-group-button">Nolan Bowl Index (NBI)</A><a href="/stats/divwins" class="brr intbtn-group-button">Division Wins</a>
<br style="clear: both">


<table class="conference">
    
    <tr><th colspan="3">All Time Nolan Bowl Standings</th>
    <tr>
        <td><label class="label">Rank</label></td>
        <td><label class="label">Name</label></td>
        
        
        <td><label class="label">Score</label></td>
        
    <tbody>
                 
         @foreach($standings as $standing) 
            
            <tr>
                <td style="text-align:center">{{$standing->rank}}</td>
                @if (Auth::user()->id == $standing->id)
                <td><label class="label"><i class="material-icons">arrow_forward_ios</i></label><a href="/user/{{$standing->id}}">{{$standing->firstname}} "{{$standing->nickname}}" {{$standing->lastname}}</a></td>
                                
                @else
                <td><a href="/user/{{$standing->id}}">{{$standing->firstname}} "{{$standing->nickname}}" {{$standing->lastname}}</a></td>
                @endif
                
                <td style="text-align:center">{{$standing->allscores}}</td>
                
             </tr>
        
        @endforeach
        
        
                        
        
   
    </tbody>
                </table>


@endsection

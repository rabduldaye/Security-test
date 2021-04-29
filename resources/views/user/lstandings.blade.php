@extends('sitelayout')
@section('title', 'Nolan Bowl: Standings')
@section('content')

<a href="/standings" class=" brl intbtn-group-button">Division</A><a href="/standings/conference" class="intbtn-group-button">Conference</A><a href="/standings/league" class="intbtn-group-button">League</a><a href="/standings/category" class="brr intbtn-group-button">Category</a>
<br style="clear: both">


<table class="conference">
    
    <tr><th colspan="9">Nolan Bowl Standings</th>
    <tr>
        <td><label class="label">Rank</label></td>
        <td><label class="label">Name</label></td>
        <td><label class="label">Conference</label></td>
        <td><label class="label">Division</label></td>
        <td><label class="label">Score</label></td>
        <td><label class="label">W</label></td>
        <td><label class="label">L</label></td>
        <td><label class="label">W-L%</label></td>
        <td><label class="label">Streak</label></td>    
    <tbody>
                 
         @foreach($standings as $standing) 
            
            <tr>
                <td style="text-align:center">{{$standing->rank}}</td>
                @if (Auth::user()->id == $standing->id)
                    <td><label class="label"><i class="material-icons">arrow_forward_ios</i></label><a href="/user/{{$standing->id }}">{{$standing->firstname}} "{{$standing->nickname}}" {{$standing->lastname}}</a></td>
                                
                @else
                    <td><a href="/user/{{$standing->id }}">{{$standing->firstname}} "{{$standing->nickname}}" {{$standing->lastname}}</a></td>
                @endif
                <td >{{$standing->conference }}</td>
                <td >{{$standing->division }}</td>
                <td style="text-align:center">{{$standing->score}}</td>
                <td style="text-align:center">{{$standing->wins}}</td>
                <td style="text-align:center">{{$scoredgames - $standing->wins}}</td>
                <td style="text-align:center">{{ ($scoredgames > 0) ? number_format($standing->wins/$scoredgames, 3) : number_format(0.000,3) }}</td>
                <td style="text-align:center">{{$standing->streak}}{{$standing->streakWL}} </td>
             </tr>
        
        @endforeach
        
        
                        
        
   
    </tbody>
                </table>


@endsection

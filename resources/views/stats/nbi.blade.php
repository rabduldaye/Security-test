@extends('sitelayout')
@section('title', 'Nolan Bowl: Nolan Bowl Index')
@section('content')

<a href="/stats" class=" brl intbtn-group-button">All Time Scores</A><a href="/stats/nbi" class="intbtn-group-button">Nolan Bowl Index (NBI)</A><a href="/stats/divwins" class="brr intbtn-group-button">Division Wins</a>
<br style="clear: both">


<table class="conference">
    
    <tr>
    @isadmin
    <th colspan="2">Nolan Bowl Index (NBI)</th><th><a href="{{ route('stats.editnbi') }}"><i class="material-icons">sync</i></a><a href="{{ route('stats.dlnbi') }}"><i class="material-icons">file_download</i></a></th>
    @else
    <th colspan="3">Nolan Bowl Index (NBI)</th>
    @endif
    
    </tr>
    <tr>
        <td><label class="label">Rank</label></td>
        <td><label class="label">Name</label></td>
        
        
        <td><label class="label">NBI</label></td>
        
    <tbody>
                 
         @foreach($standings as $standing) 
            
            <tr>
                <td style="text-align:center">{{$standing->rank}}</td>
                @if (Auth::user()->id == $standing->id)
                <td><label class="label"><i class="material-icons">arrow_forward_ios</i></label><a href="/user/{{$standing->id}}">{{$standing->firstname}} "{{$standing->nickname}}" {{$standing->lastname}}</a></td>
                                
                @else
                <td><a href="/user/{{$standing->id}}">{{$standing->firstname}} "{{$standing->nickname}} " {{$standing->lastname}}</a></td>
                @endif
                
                <td style="text-align:center">{{$standing->nbi}}</td>
                
             </tr>
        
        @endforeach
        
        
                        
        
   
    </tbody>
                </table>


@endsection

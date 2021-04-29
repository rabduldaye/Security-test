@extends('sitelayout')
@section('title', 'Nolan Bowl: Admin')
@section('content')

  <table class="main">
    <thead>
        <tr class="table-warning">
          
          <th>Name</th>
          
          <th>Location</th>
          @isadmin
          <th>Pick %</th>
          @endisadmin
          <!--
          <th class="text-center">Action</th>
          --->
          </td>
        </tr>
    </thead>
    <tbody>
        @foreach($user as $user)
        
        <tr>
            
            <td> <a href="{{ route('user.show', $user->id)}}" class="btn btn-primary btn-sm">{{$user->firstname}} "{{$user->nickname}} " {{$user->lastname}}</a></td>
           
            <td>{{$user->city}}, {{$user->state}}</td>
            @isadmin
           
            <td >{{ ($numGames != 0) ? number_format(($user->picks / $numGames)*100,0) : number_format(0.000,0) }}%</td>
            @endisadmin
            
            <!--
            
            -->
        </tr>
        
        @endforeach
    </tbody>
  </table>

@endsection

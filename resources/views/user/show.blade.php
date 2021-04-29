@extends('sitelayout')
@section('title', 'Nolan Bowl: Admin')
@section('content')

  <table >
    <thead>
        <tr>
            
            <th>{{$user->full_name}}</th>
            <th><div style="float: right">
            <a  href="{{ url()->previous() }}"><i class="material-icons">undo</i></a>
            <a  href="/picks/{{ $user->id }}"><i class="material-icons">fact_check</i></a>
            
            @if( $canedit ) 
            <a  href="/user/editpwd/{{ $user->id }}"><i class="material-icons">password</i></a>
            <a  href="{{ route('user.edit', $user->id)}}"><i class="material-icons">edit</i></a>
            @endif
            @isadmin
            <form action="{{ route('user.destroy', $user->id)}}" method="post">    
        
                  
                  
                  @csrf
                  @method('DELETE')
                  <button class="picth" type="submit"><i class="material-icons">delete</i></button>
                </form>
        @endisadmin        
              
</div>
            </th>
            
          
          
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><label class="label">Full Name:</label></td>

            <td>{{$user->full_name}} </td>

        </tr>
        <tr>
            <td><label class="label">Email:</label></td>
            <td>{{$user->email}} </td>
        </tr>
        <tr>
            <td><label class="label">Location:</label></td>
            <td>{{$user->location}} </td>
        </tr>
        <tr>
            <td><label class="label">Bowling Average:</label></td>
            <td>{{$user->bowling}} </td>
        </tr>
        <tr>
            <td><label class="label">How do you know Matt?:</label></td>
            <td>{{$user->knowme}} </td>
        </tr>
        <tr>
            <td><label class="label">Favorite Sports Team?:</label></td>
            <td>{{$user->favsport}} </td>
        </tr>
        <tr>
            <td><label class="label">Recent News:</label></td>
            <td>{{$user->news}} </td>
        </tr>
        <tr>
            <td><label class="label">{{$cq1}}:</label></td>
            <td>{{$user->cq1}} </td>
        </tr>
        <tr>
            <td><label class="label">{{$cq2}}:</label></td>
            <td>{{$user->cq2}} </td>
        </tr>
        <tr>
            <td><label class="label">Smack Talk:</label></td>
            <td>{{$user->smack}} </td>
        </tr>
        @if (!$user->division == "")
        <tr>
            <td><label class="label">Division:</label></td>
            <td>{{$user->division}} </td>
        </tr>
        @endif
        @if (!$user->conference == "")
        <tr>
            <td><label class="label">Conference:</label></td>
            <td>{{$user->conference}} </td>
        </tr>
        @endif
        <tr>
            <td><label class="label">All Time Scores:</label></td>
            <td>{{$user->allscores}} </td>
        </tr>
        <tr>
            <td><label class="label">Division Wins:</label></td>
            <td>{{$user->divisionWins}} </td>
        </tr>    
        <tr>
            <td><label class="label">Nolan Bowl Index:</label></td>
            <td>{{$user->nbi}} </td>
        </tr>


        @isadmin
            <tr>
                <td><label class="label">Tags:</label></td>
            <td>{{$user->tags}} </td>
        </tr>   
        <tr>
                <td><label class="label">Status:</label></td>
            <td>{{$user->status}} </td>
        </tr>   
        
        <tr>
            <td><label class="label">Coin Flip:</label></td>
            <td>{{$user->coinflip}} </td>
        </tr>
        @endisadmin

</table>
@endsection

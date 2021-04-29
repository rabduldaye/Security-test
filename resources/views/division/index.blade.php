@extends('sitelayout')

@section('pagetitle', ': Divisions') 
@section('content')


<table>

  <tr>
    <th colspan="2">Divisions</th><th><a style="float: right" href="{{ route('division.create') }}"><i class="material-icons">add</i></a>
    <a style="float: right" href="{{ route('user.usersorter') }}"><i class="material-icons">sort</i></a>
    
    </th>      
  </tr>
  
  <tr>
    <th class="interior">Conference</th>
    <th  class="interior">Division</th>
    <th  class="interior">&nbsp;</th>
  </tr>
  
  
  
  
        @foreach($division as $division)
        <tr>
          
          <td>{{$division->conference}}</td>
          <td>{{$division->name}}</td>
          <td><a style="padding-left: 10px" href="{{ route('division.edit', $division->id)}}" class="btn btn-primary btn-sm"><i class="material-icons">edit</i></a>
              <form action="{{ route('division.destroy', $division->id)}}" method="post">    
                  
                  
                  
                    @csrf
                    @method('DELETE')
                    <button class="pic" type="submit"><i class="material-icons">delete</i></button>
                  </form>
          </td>  


        </tr>
        @endforeach
    </tbody>
  </table>
<div>
@endsection

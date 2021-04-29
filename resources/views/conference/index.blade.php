@extends('sitelayout')

@section('pagetitle', ': Conferences') 
@section('content')


<table>

  <tr>
    <th >Conferences</th><th><a style="float: right" href="{{ route('conference.create') }}"><i class="material-icons">add</i></a></th>      
  </tr>
  
  
    @foreach($conference as $conferences)
        <tr>
          <td>{{$conferences->name}}</td>
          
          <td><a style="padding-left: 10px" href="{{ route('conference.edit', $conferences->id)}}" class="btn btn-primary btn-sm"><i class="material-icons">edit</i></a>
              <form action="{{ route('conference.destroy', $conferences->id)}}" method="post">    
                  
                  
                  
                    @csrf
                    @method('DELETE')
                    <button class="pic" type="submit"><i class="material-icons">delete</i></button>
                  </form>
          </td>  


        </tr>
        @endforeach
        
</table>

@endsection
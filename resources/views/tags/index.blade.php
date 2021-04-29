@extends('sitelayout')

@section('pagetitle', ': Tags') 
@section('content')



  <table>

    <tr>
      <th >Tags</th><th><a style="float: right" href="{{ route('tags.create') }}"><i class="material-icons">add</i></a><a style="float: right" href="{{ route('tags.usersorter') }}"><i class="material-icons">sort</i></th>      
    </tr>
  
    @foreach($tags as $tag)
        <tr>
          <td>{{$tag->name}}</td>
          <td><a style="padding-left: 10px" href="{{ route('tags.edit', $tag->id)}}" class="btn btn-primary btn-sm"><i class="material-icons">edit</i></a>
              <form action="{{ route('tags.destroy', $tag->id)}}" method="post">    
                  
                  
                  
                    @csrf
                    @method('DELETE')
                    <button class="pic" type="submit"><i class="material-icons">delete</i></button>
                  </form>
          </td>
        </tr>
        @endforeach
        
  </table>

@endsection
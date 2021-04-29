@extends('sitelayout')

@section('pagetitle', ': Edit Tag') 
@section('content')



<table>

  <tr>
    <th>Edit Tag</th><th><a style="float: right" href="/tags"><i class="material-icons">undo</i></a></th>
  </tr>
  <form method="post" action="{{ route('tags.update', $tag->id) }}">
    @csrf
    @method('PATCH')
    <tr>
      <td colspan="2"><label for="name" class="label ">Name:</label><input type="text" class="textfield" name="name" value="{{$tag->name}}" /></td>
      
    </tr>
    <tr>
      <td colspan="2"><button type="submit" class="btn btn-block btn-danger">Edit Tag</button></td>
    </tr>
    </form>
</table>

    

@endsection








@extends('sitelayout')

@section('pagetitle', ': Edit Conference') 
@section('content')


<form method="post" action="{{ route('conference.update', $conference->id) }}">
    @csrf
    @method('PATCH')

<table>

  <tr>
    <th>Edit Conference</th><th><a style="float: right" href="/conference"><i class="material-icons">undo</i></a></th>
  </tr>
  <tr>
    <td><label class="label">Name:</label></td>
    <td><input type="text" class="textfield"  name="name" value="{{ $conference->name }}"/></td>
  </tr>
  <tr>
    <td colspan="2"><button type="submit" class="btn btn-block btn-danger">Update Conference</button></td>
  </tr>
</table>
      

</form>
@endsection
@extends('sitelayout')
@section('title', 'Nolan Bowl XXXXI: Edit the Rules')
@section('content')

<form method="post" action="{{ route('config.rulesupdate') }}">
@csrf           
<table class="main">
                    
    <thead>
    <tr>
        <th>Rules </th>
      </tr>
    <tr>
      <td style="padding: 10px 10px 10px 10px; width: 99%; "><textarea name="rules" style="width: 99%; " rows=20>{!! $rules !!}</textarea></td>
    </tr>
    <tr>
      <td><button type="submit" class="btn btn-block btn-danger">Update the Rules</button></td>
    </tr>
</table>
</form>


@endsection

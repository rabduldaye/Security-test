@extends('sitelayout')
@section('title', 'Nolan Bowl XXXXI: Edit the Rules')
@section('content')

<form method="post" action="{{ route('config.mapupdate') }}">
@csrf           
<table class="main">
                    
    <thead>
    <tr>
        <th>Embedded Map:</th>
      </tr>
    <tr>
      <td style="padding: 10px 10px 10px 10px"><textarea name="mapembed" style="width: 99%; " rows=20>{!! $config->mapembed !!}</textarea></td>
    </tr>
    <tr>
      <td><button type="submit" class="btn btn-block btn-danger">Update the Map</button></td>
    </tr>
</table>
</form>


@endsection

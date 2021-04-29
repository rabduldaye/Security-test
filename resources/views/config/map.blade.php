@extends('sitelayout')
@section('title', 'Nolan Bowl XXXXI: Rules')
@section('content')

           
<table >
                    
    <tr>
        @isadmin
            <th>User Locations</th><th><a style="float: right" href="{{ route('config.editmap')}}" ><i class="material-icons">edit</i></a></th>
                        
        @else
            <th colspan="2">User Locations </th>
        @endisadmin
    </tr>
    <tr>
        <td colspan="2"><!-- rules goes here -->
            {!! $config->mapembed !!}
        </td>
    </tr>
</table>
 
@endsection

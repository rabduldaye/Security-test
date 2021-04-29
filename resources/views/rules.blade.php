@extends('sitelayout')
@section('title', 'Nolan Bowl XXXXI: Rules')
@section('content')

            
<table class="main">
                    
   
    <tr>
        @isadmin
        <th>Rules</th><th><a style="float: right" href="{{ route('config.editrules')}}" ><i class="material-icons">edit</i></a></th>
        
      @else
      <th colspan="2">Rules </th>
      @endisadmin
    </tr>
    <tr>
            <td colspan="2"><!-- rules goes here -->
                 {!! $rules !!}
            </td>
        </tr>
</table>
            
@endsection

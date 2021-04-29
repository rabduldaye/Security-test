@extends('sitelayout')
@section('title', 'Nolan Bowl: Config')
@section('content')

  <table >
    <thead>
        <tr>
            
            <th>Site Configuration</th>
            <th><div style="float: right">
            <a  href="{{ url()->previous() }}"><i class="material-icons">undo</i></a>
           
            
            <a  href="/config/edit"><i class="material-icons">edit</i></a>
            
            
              
</div>
            </th>
            
          
          
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><label class="label">Welcome:</label></td>

            <td>{{$config->welcome}} </td>

        </tr>
        <tr>
            <td><label class="label">Title:</label></td>

            <td>{{$config->title}} </td>

        </tr>
        <tr>
            <td><label class="label">Custom Question 1:</label></td>

            <td>{{$config->cq1}} </td>

        </tr>
        <tr>
            <td><label class="label">Custom Question 2:</label></td>

            <td>{{$config->cq2}} </td>

        </tr>

        <tr>
            <td><label class="label">Michigan ID:</label></td>

            <td>{{$config->michiganID}} </td>

        </tr>
        <tr>
            <td><label class="label">Notre Dame ID:</label></td>

            <td>{{$config->notredameID}} </td>

        </tr>



</table>
@endsection

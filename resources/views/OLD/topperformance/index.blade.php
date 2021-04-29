@extends('testlayout')

@section('content')

<style>
  .push-top {
    margin-top: 50px;
  }
</style>
<div class="push-top">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}
    </div><br />
  @endif

  @isadmin
  <table>
    <tr><a href="{{ route('topperformance.create')}}" class="btn btn-primary btn-sm"> Add All Time Top Performance</a></tr>
   
  </table>


  @endisadmin

  <table class="table">
    <thead>
        <tr class="table-warning">
          
          <td>Name</td>
          <td>Season</td>
          <td>Performace</td>
          <td class="text-center">Action</td>
          <td>
          </td>
        </tr>
    </thead>
    <tbody>
        @foreach($topperformance as $topperformance)
       
        <tr> 
            
            <td>{{$topperformance->name}}</td>
            <td>{{$topperformance->season}}</td>
            <td>{{$topperformance->performance}}%</td>
              <td class="text-center">
                <a href="{{ route('topperformance.show', $topperformance->id)}}" class="btn btn-primary btn-sm">Show</a>
                <a href="{{ route('topperformance.edit', $topperformance->id)}}" class="btn btn-primary btn-sm">Edit</a>
                <form action="{{ route('topperformance.destroy', $topperformance->id)}}" method="post" style="display: inline-block">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm type=" submit>Delete</button>
                  </form>
            </td>
        </tr>
      
        @endforeach
    </tbody>
  </table>
<div>
@endsection

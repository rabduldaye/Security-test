@extends('testLayout')

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
  <table class="headerTable">
    <td><a href="{{ route('divisiontitles.create')}}" class="btn btn-primary btn-sm"> Add Most Division titles</a></td>
  </table>
  <table class="table">
    <thead>
        <tr class="table-warning">
          <th>ID</th>
          <th>Name</th>
          <th>Wins</th>
          <td class="text-center">Action</td>
          <td>
          </td>
        </tr>
    </thead>
    <tbody>
        @foreach($mostdivision as $mostdivision)
        <tr>
          <td>{{$mostdivision->id}}</td>
          <td>{{$mostdivision->name}}</td>
            <td>{{$mostdivision->wins}}</td>
            <td class="text-center">
                <a href="{{ route('divisiontitles.edit', $mostdivision->id)}}" class="btn btn-primary btn-sm">Edit</a>
                <form action="{{ route('divisiontitles.destroy', $mostdivision->id)}}" method="post" style="display: inline-block">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm"" type="submit">Delete</button>
                  </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
@endsection

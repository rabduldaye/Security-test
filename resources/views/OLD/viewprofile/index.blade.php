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
  <td><a href="{{ route('viewprofile.update')}}" class="btn btn-primary btn-sm">Update Profile</a></td>
  </table>
  <table class="table">
    <thead>
        <tr class="table-warning">
            <th>Name</th>
            <th>Location</th>
        </tr>
    </thead>
    <tbody>

        @foreach($viewprofile as $viewprofile)
        <tr>

                <td>{{$viewprofile->name}}</td>
                <td>{{$viewprofile->location}}</td>
        </tr>

        @endforeach
    </tbody>
    </table>

@endsection

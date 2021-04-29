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
  <table>
    <tr><a href="{{ route('user.index')}}" class="btn btn-primary btn-sm">All users</a></tr>
    <tr><a href="{{ route('user.newuser')}}" class="btn btn-primary btn-sm">New users</a></tr>
    <tr><a href="{{ route('user.approveduser')}}" class="btn btn-primary btn-sm">Approved users</a></tr>
    <tr><a href="{{ route('user.create')}}" class="btn btn-primary btn-sm">New user</a></tr>
  </table>
  <table class="table">
    <thead>
        <tr class="table-warning">
          <td>ID</td>
          <td>First Name</td>
          <td>Last Name</td>
          <td>Email</td>
          <td>Phone</td>
          <td>Password</td>
          <td>Status</td>
          <td>Hash<td>
          <td class="text-center">Action</td>
          <td>
          </td>
        </tr>
    </thead>
    <tbody>
        @foreach($user as $user)
        @if(!empty($user->status))
        <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->firstname}}</td>
            <td>{{$user->lastname}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->phone}}</td>
            <td>{{$user->password}}</td>
            <td>{{$user->status}}</td>
            <td>{{$user->hash}}</td>
            <td class="text-center">
                <a href="{{ route('user.show', $user->id)}}" class="btn btn-primary btn-sm">Show</a>
                <a href="{{ route('user.edit', $user->id)}}" class="btn btn-primary btn-sm">Edit</a>
                <form action="{{ route('user.destroy', $user->id)}}" method="post" style="display: inline-block">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                  </form>
            </td>
        </tr>
        @endif
        @endforeach
    </tbody>
  </table>
<div>
@endsection

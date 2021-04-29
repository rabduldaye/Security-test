@extends('testLayout')

@section('content')

<style>
    .container {
      max-width: 450px;
    }
    .push-top {
      margin-top: 50px;
    }
</style>

<div class="card push-top">
  <div class="card-header">
    Add user
  </div>

  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('user.store') }}">
        <div class="form-group">
            @csrf
            <label for="nickname">nickname</label>
            <input type="text" class="form-control" name="nickname"/>
        </div>
        <div class="form-group">
            <label for="name"> Name</label>
            <input type="text" class="form-control" name="name"/>
        </div>
        <div class="form-group">
            <label for="lastname"> Last Name  </lable>
            <input type="text" class="form-control" 
name="lastname"/>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email"/>
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="tel" class="form-control" name="phone"/>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="text" class="form-control" name="password"/>
        </div>
        <div class="form-group">
            <label for="city">City</label>
            <input type="text" class="form-control" name="city"/>
        </div>
        <div class="form-group">
            <label for="state">State</label>
            <input type="text" class="form-control" name="state"/>
        </div>
        <div class="form-group">
            <label for="bowling">Bowling average:</label>
            <input type="text" class="form-control" name="bowling"/>
        </div>
        <div class="form-group">
		<label for="cq1">Custom Question 1: What's Your Biggest Accomplishment? </label>
		<input type="cq1" class="form-control" 
name="cq1"/>
        </div>
        <div class="form-group">
          <label for="cq2"> Custom Question 2: Who is Your Favorite Athlete? </label>
          <input type="text" class="form-control" 
name="cq2"/>
          </div>
          <div class="form-group">
            <label for="favsport">What's your favorite sports team?</label>
            <input type="text" class="form-control" name="favsport"/>
        </div>
        <div class="form-group">
            <label for="knowme">How do you know Nolan? Are you happy with that?</label>
            <input type="text" class="form-control" name="knowme"/>
        </div>
        <div class="form-group">
            <label for="news">Recent News</label>
            <input type="text" class="form-control" name="news"/>
        </div>
        <div class="form-group">
            <label for="smack">Smack Talk!</label>
            <input type="text" class="form-control" name="smack"/>
        </div>
          <button type="submit" class="btn btn-block btn-danger">Create user</button>
      </form>
  </div>
</div>
@endsection

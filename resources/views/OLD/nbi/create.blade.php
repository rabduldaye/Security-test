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
    Add User
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
      <form method="post" action="{{ route('nbi.store') }}">
        <div class="form-group">
            @csrf
            <label for="nickname">Participant</label>
            <input type="text" class="form-control" name="nickname"/>
        </div>
        
        <div class="form-group">
            <label for="nbiraw">NBI RAW</label>
            <input type="text" class="form-control" name="nbiraw"/>
        </div>
        
          <button type="submit" class="btn btn-block btn-danger">Add NBI</button>
      </form>
  </div>
</div>
@endsection

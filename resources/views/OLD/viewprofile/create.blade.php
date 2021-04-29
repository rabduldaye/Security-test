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
    User profile
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
    <form method="post" action="{{ route('viewprofile.store') }}">
        <div class="form-group">
            @csrf
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name"/>
        </div>
        <div class="form-group">
            <label for="location">Location</label>
            <input type="text" class="form-control" name="location"/> 
        </div>
    </form>
</div>
</div>
@endsection
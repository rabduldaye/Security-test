@extends('testlayout')

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
    Inputs
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
      <form method="post" action="{{ route('topperformance.store') }}">
        <div class="form-group">
            @csrf
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name"/>
        </div>
        <div class="form-group">
            <label for="season">Season</label>
            <input type="text" class="form-control" name="season"/> 
        </div>
        <div class="form-group">
            <label for="performance">Performance Percentage</label> 
            <input type="text" class="form-control" name="performance"/>
        </div>
        
          <button type="submit" class="btn btn-block btn-danger">Create All time Top Performance</button>
      </form>
  </div>
</div>
@endsection

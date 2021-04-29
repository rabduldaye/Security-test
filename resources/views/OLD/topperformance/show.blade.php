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
    Information:
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
      <div >
          <!-- <div class="form-group">
              <label for="id">id: {{ $topperformance->id }}</label>
          </div> -->
          <div class="form-group">
              @csrf
              @method('PATCH')
              <label for="name">Name: {{ $topperformance->name }}</label>
          </div>
          <div class="form-group">
              <label for="season">Season: {{ $topperformance->season }}</label>
          </div>
          <div class="form-group">
              <label for="performance">Performance: {{ $topperformance->performance }}%</label>
          </div>
          <a href="{{ route('topperformance.index')}}" class="btn btn-block btn-danger">Return</a>
      </div>
  </div>
</div>
@endsection

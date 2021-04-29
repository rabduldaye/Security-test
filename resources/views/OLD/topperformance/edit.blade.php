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
  <td>List Number ( {{$topperformance->id}} )</td>
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
      <form method="post" action="{{ route('topperformance.update', $topperformance->id) }}">
      
      <div class="form-group">
              @csrf
              @method('PATCH')
              <label for="name">Name</label>
              <input type="text" class="form-control" name="name" value="{{ $topperformance->name }}"/>
          </div>
          <div class="season">
              <label for="season">Season</label>
              <input type="text" class="form-control" name="season" value="{{ $topperformance->season }}"/>
          </div>
          <div class="performance">
              <label for="performance">Performance</label>
              <input type="text" class="form-control" name="performance" value="{{ $topperformance->performance }}"/>
              
          </div>
          <button type="submit" class="btn btn-block btn-danger">Update</button>

      </form>
  </div>
</div>
@endsection

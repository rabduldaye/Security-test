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
    Ranking Info:
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
      <div>

      <div class="form-group">
            <label for="name">name: {{ $alltimerank->name }}</label>
      </div>
            <label for="points">points: {{ $alltimerank->points }}</label>
      </div>
      <div class="form-group">
              <label for="rank">rank: {{ $alltimerank->rank }}</label>
      </div>

      <a href="{{ route('alltimerank.index')}}" class="btn btn-block btn-danger">Return</a>
      </div>
  </div>
</div>
@endsection

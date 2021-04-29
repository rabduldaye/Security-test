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
    Edit & Update
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
      <form method="post" action="{{ route('nbi.update', $nbi->id) }}">
          <div class="form-group">
              @csrf
              @method('PATCH')
              <label for="nickname">Participant</label>
              <input type="text" class="form-control" name="nickname" value="{{ $nbi->nickname }}"/>
          </div>
          
          <div class="form-group">
              <label for="nbiraw">NBI RAW</label>
              <input type="text" class="form-control" name="nbiraw" value="{{ $nbi->nbiraw }}"/>
          </div>
          

          <button type="submit" class="btn btn-block btn-danger">Update User</button>
      </form>
  </div>
</div>
@endsection

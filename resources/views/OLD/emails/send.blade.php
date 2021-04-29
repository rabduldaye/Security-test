@extends('testLayout')

@section('content')

<div class="card push-top">
  <div class="card-header">
    Send Email
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

    
      <form method="post" action="{{ url('mail/send') }}">
        
        <div class="form-group">
            @csrf
            <label for="to"> To: </label>
            <input type="text" class="form-control" name="to"/>
        </div>
        <div class="form-group">
            <label for="message"> Message: </lable>
            <textarea name="message" class="form-control"></textarea>
        </div>
        
          <button type="submit" class="btn btn-block btn-danger">Send Email</button>
      </form>
  </div>
</div>

@endsection
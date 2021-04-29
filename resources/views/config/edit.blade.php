@extends('sitelayout')
@section('pagetitle',  ': Edit Site Configuration')
@section('content')



<form method="post" action="{{ route('config.update') }}">     
@csrf
                  
  <table >

  <tr>
    <th>Edit Site Configuration Game</th><th><a style="float: right" href="/config"><i class="material-icons">undo</i></a></th>
  </tr>
  <tr>
    <td colspan="2" style="padding-bottom: 0px; padding-top: 10px">
      <label for="welcome" class="label col-md-4 col-form-label text-md-right">Welcome:</label><br>
      <textarea cols="50" rows="5" name="welcome" required>{{ $config->welcome }}
      @if ($errors->has('welcome'))
        <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->first('welcome') }}</strong>
        </span>
      @endif   
      </textarea>
      <p>      
      <label class="label" for="title">Title:</label><br>
      <input type="text" class="textfield" name="title" value="{{ $config->title }}"/><p>

      <label for="cq1" class="label col-md-4 col-form-label text-md-right">Custom Question 1:</label><br>
      <textarea cols="50" rows="5" name="cq1" required>{{ $config->cq1 }}
      @if ($errors->has('cq1'))
        <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->first('cq1') }}</strong>
        </span>
      @endif   
      </textarea><p>
      <label for="cq2" class="label col-md-4 col-form-label text-md-right">Custom Question 2:</label><br>
      <textarea cols="50" rows="5" name="cq2" required>{{ $config->cq2 }}
      @if ($errors->has('cq2'))
        <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->first('cq2') }}</strong>
        </span>
      @endif   
      </textarea><p>
      <label class="label" for="michiganID">Michigan ID:</label><br>
      <input type="text" class="textfield" name="michiganID" value="{{ $config->michiganID }}"/><p>
      @if ($errors->has('michiganID'))
        <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->first('michiganID') }}</strong>
        </span>
      @endif   
      <label class="label" for="notredameID">Notre Dame ID:</label><br>
      <input type="text" class="textfield" name="notredameID" value="{{ $config->notredameID }}"/>
      @if ($errors->has('notredameID'))
        <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->first('notredameID') }}</strong>
        </span>
      @endif  
  </td>
  <tr>
  <td colspan="2" style="padding-top: 0px"><button type="submit" class="btn btn-block btn-danger">Edit Config</button></td>
  </tr>

  </table>
</form>
  
@endsection

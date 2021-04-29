@extends('sitelayout')
@section('pagetitle',  ': Edit Site Configuration')
@section('content')



<form method="post" action="{{ route('stats.updatenbi') }}">     
@csrf
                  
  <table >

  <tr>
    <th>Batch Update NBI</th><th><a style="float: right" href="/stats/nbi"><i class="material-icons">undo</i></a></th>
  </tr>
  <tr>
    <td colspan="2" style="padding-bottom: 0px; padding-top: 10px">
      <label for="nbidata" class="label col-md-4 col-form-label text-md-right">Enter NBI data below:</label><br>
      <textarea cols="60" rows="30" name="nbidata" required>
      @if ($errors->has('welcome'))
        <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->first('nbidata') }}</strong>
        </span>
      @endif   
      </textarea>
      <p>      
      
  <tr>
  <td colspan="2" style="padding-top: 0px"><button type="submit" class="btn btn-block btn-danger">Edit Config</button></td>
  </tr>

  </table>
</form>
  
@endsection

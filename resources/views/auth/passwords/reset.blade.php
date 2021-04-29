@extends('welcomelayout')
@section('pagetitle', 'Reset your Nolanbowl Password') 
@section('content')

<form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        

                        <input type="hidden" name="token" value="{{ $token }}">

                        
<table >                    
    <tr>
        <th colspan="2">Reset your password</th>
    </tr>
    <tr>
        <td colspan="2" style="padding-bottom: 0px">

                        
        <label for="email" class="label">{{ __('E-Mail Address') }}:</label><br>

                            
                            
<input id="email" type="email" class="textfield form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>

@if ($errors->has('email'))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->first('email') }}</strong>
    </span>
@endif
<p>

                            
<label class="label" for="password" >{{ __('Password') }}:</label><br>

                            
<input id="password" type="password" class="textfield form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

@if ($errors->has('password'))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->first('password') }}</strong>
    </span>
@endif
<p>


<label class="label" for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}:</label><br>


<input id="password-confirm" type="password" class="textfield form-control" name="password_confirmation" required>



        </td>
    </tr>
    </tr>
        <td colspan="2">
            <button type="submit" class="btn btn-block btn-danger">Update Password</button>
        </td>


    </tr>



</table>
                        
                        
</form>
               

@endsection



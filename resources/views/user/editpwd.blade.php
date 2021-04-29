@extends('sitelayout')
@section('title', 'Nolan Bowl XXXXI: Games')
@section('content')


<form method="post" action="{{ route('user.updatepwd', $user->id) }}">
          
@csrf

              
<table >
    
        @isadmin
        <tr><th>Edit  {{$user->firstname}}'s Password:</th><th><a style="float: right" href="{{ url()->previous() }}" ><i class="material-icons">undo</i></a></th></tr>
        @else
        <tr><th>Edit  Your Password:</th><th><a style="float: right" href="{{ url()->previous() }}" ><i class="material-icons">undo</i></a></th></tr>
        @endisadmin
        




        <tr>
        @isadmin
        @else
        <td>
                 <label for="password" class="label col-md-4 col-form-label text-md-right">Old Password:</label></td>

                            
                 <td><input id="password" type="password" class="textfield form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                <br>
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif

                </td>
            </tr>
        @endisadmin
                
    <tr>
                <td>
                 <label for="newpassword" class="label col-md-4 col-form-label text-md-right">New Password:</label></td>

                            
                 <td><input id="newpassword" type="newpassword" class="textfield form-control{{ $errors->has('newpassword') ? ' is-invalid' : '' }}" name="newpassword" required>

                                @if ($errors->has('newpassword'))
                                    <br>
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('newpassword') }}</strong>
                                    </span>
                                @endif

                </td>
            </tr>
            <tr>
                <td>
                 <label for="password" class="label col-md-4 col-form-label text-md-right">New Password:</label></td>

                            
                 <td><input id="password_confirmation" type="password" class="textfield form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password_confirmation" required>

                                @if ($errors->has('password_confirmation'))
                                <br>
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif

                </td>
            </tr>
            <tr>
                <td colspan="2">
                <button type="submit" class="btn btn-block btn-danger">Update Password</button>
                </td>
            </tr>


            </table>  
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
                        
      </form>

@endsection

<!DOCTYPE html>
<html>

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>{{ $title }}  -> Login</title>
   <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
   <link href="/css/test.css" rel="stylesheet">
   
   <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>



    

</head>

<body>
<titlebar>
    <div class="nav-links-container">
        <img src="http://nolanbowl.com/images/Nolan%20Bowl%20final.png" width="95" height="75" padding="0">
        <h1>{{ $title }} </h1>
        

    </div>
    </titlebar>
    
    <navbar>

        <div class="subtitle">
            Welcome to Matt Nolan's Annual College Football Bowl Pool
            
        </div>
    </navbar>
    <contentBox><content>
        @if (session('status'))
          <div class="alert alert-success">
            {{ session('status') }}
          </div>
        @endif
            
                <table class="main">
                    
                <thead><tr><th class="collapsable">Rules</th><th>Login</th></tr></thead>

                <tr>
                <td class="collapsable">
                <!-- rules goes here -->
                {!! $rules !!}
                </td>
                <td valign="top">
                <!-- login form goes here -->
                <form method="POST" action="{{ route('login') }}">
                      @csrf
                
                        <label for="email" class="label col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}:</label><br>
                        <!--  form-control{{ $errors->has('email') ? ' is-invalid' : '' }} -->
                          <input id="email" type="email" class="textfield" name="email" value="{{ old('email') }}" required autofocus>

                              @if ($errors->has('email'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('email') }}</strong>
                                  </span><br>
                              @endif
                        
                        <label for="password" class="label col-md-4 col-form-label text-md-right">{{ __('Password') }}:</label><br>
                            <input class="textfield" id="password" type="password" class="textfield form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                              @if ($errors->has('password'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('password') }}</strong>
                                  </span><br>
                              @endif
                        
                            
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>
                        <p>
                        <button type="submit" class="btn btn-primary">{{ __('Login') }}</button><p>
                        
                        <a id="forgotPass" class="btn btn-link" href="{{ route('password.request') }}">Forgot Password?</a><p>
                            <a class="btn btn-link" href="{{ route('register')}}">Register?</a><p>

                    </form>
                
                </td>
                </table>
            
    </content></contentBox>
</body>
</html>

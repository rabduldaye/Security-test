<!DOCTYPE html>
<html>

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>{{ $title }}  -> Register</title>
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
            Please Register for Matt Nolan's Annual College Football Bowl Pool
            
        </div>
    </navbar>
    <contentBox><content>

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <table >
            <thead><tr><th colspan="2">Register</th></tr></thead>




            <tr>
                <td><label for="firstname" class="label col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label></td>
                <td><input id="firstname" type="text" class="textfield form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }}" name="firstname" value="{{ old('firstname') }}" required>
                    @if ($errors->has('firstname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('firstname') }}</strong>
                                    </span>
                     @endif   
                    

                </td>
            </tr>
            <tr>
                <td>
                    <label for="nickname" class="label col-md-4 col-form-label text-md-right">{{ __('Nickname') }}</label></td>
                    <td><input id="nickname" type="text" class="textfield form-control{{ $errors->has('nickname') ? ' is-invalid' : '' }}" name="nickname" value="{{ old('nickname') }}" required autofocus>
                    @if ($errors->has('nickname'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('nickname') }}</strong>
                        </span>
                    @endif
                </td>
            </tr>
            
            <tr>
                <td>
                    <label for="lastname" class="label col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label></td>


                    <td><input id="lastname" type="text" class="textfield form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}" name="lastname" value="{{ old('lastname') }}" required>

                    @if ($errors->has('lastname'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('lastname') }}</strong>
                        </span>
                    @endif   
                    

                </td>
            </tr>
            <tr>
                <td>
                <label for="email" class="label col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label></td>


                <td><input id="email" type="email" class="textfield form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif

                </td>
            </tr>
            <tr>
                <td>
                 <label for="password" class="label col-md-4 col-form-label text-md-right">{{ __('Password') }}</label></td>

                            
                 <td><input id="password" type="password" class="textfield form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif

                </td>
            </tr>
            <tr>
                <td>
                 <label for="password" class="label col-md-4 col-form-label text-md-right">{{ __('Password') }}</label></td>

                            
                 <td><input id="password_confirmation" type="password" class="textfield form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password_confirmation" required>

                                @if ($errors->has('password_confirmation'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif

                </td>
            </tr>
            <tr>
                <td>
                    <label for="city" class="label col-md-4 col-form-label text-md-right">City</label></td>
                    
                    <td> <input id="city" type="text" class="textfield" name="city" required>
                    @if ($errors->has('city'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                     @endif   
                
                </td>
            </tr>
            <tr>
                <td>
                    <label for="state" class="label col-md-4 col-form-label text-md-right">State (Abbreviation)</label></td>
                    
                    <td><input id="state" type="text" class="textfield" name="state" required>
                    @if ($errors->has('state'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('state') }}</strong>
                                    </span>
                     @endif   
                
                </td>
            </tr>
            <tr>
                <td>
                    <label for="bowl" class="label col-md-4 col-form-label text-md-right">Bowling Average:</label></td>
                    
                    <td><input id="bowl" type="text" class="textfield" name="bowl" required>
                    @if ($errors->has('bowl'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('bowl') }}</strong>
                                    </span>
                     @endif   
                
                </td>
            </tr>    



            <tr>
                <td colspan="2">
                    <label for="knowme" class="label col-md-4 col-form-label text-md-right">How do you know me?</label><br>

                    <textarea cols="50" rows="5" name="knowme" required>
                    @if ($errors->has('knowme'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('knowme') }}</strong>
                                    </span>
                     @endif   
                     </textarea>
                
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="cq1" class="label col-md-4 col-form-label text-md-right">{{ config('app.config.cq1')  }}</label><br>

                    <textarea cols="50" rows="5" name="cq1" required>
                    @if ($errors->has('cq1'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('cq1') }}</strong>
                                    </span>
                     @endif 
                     </textarea>
                
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="cq2" class="label col-md-4 col-form-label text-md-right">{{ $cq2 }}</label><br>

                    <textarea cols="50" rows="5" name="cq2" required>
                    @if ($errors->has('cq2'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('cq2') }}</strong>
                                    </span>
                     @endif
                     </textarea>
                
                </td>
            </tr>
            <tr>
                <td>
                    <label for="favsport" class="label col-md-4 col-form-label text-md-right">Favorite Sports Team:</label></td>

                    <td><input id="favsport" type="text" class="textfield" name="favsport" required>
                    @if ($errors->has('favsport'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('favsport') }}</strong>
                                    </span>
                     @endif  
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="news" class="label col-md-4 col-form-label text-md-right">Recent News?</label><br>

                    <textarea cols="50" rows="5" name="news" required>
                    @if ($errors->has('news'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('news') }}</strong>
                                    </span>
                     @endif
                     </textarea>
                
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="smack" class="label col-md-4 col-form-label text-md-right">Smack Talk?</label><br>

                    <textarea cols="50" rows="5" name="smack" required>
                    @if ($errors->has('smack'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('smack') }}</strong>
                                    </span>
                     @endif
                     </textarea>
                
                </td>
            </tr>
            <tr>
                <td colspan="2">
                <button type="submit" class="btn btn-primary">
                                  {{ __('Register') }}
                              </button>
                </td>
            </tr>


            </table>
                     
            </content></contentBox>
</body>
</html>
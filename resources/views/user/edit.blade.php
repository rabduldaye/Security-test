@extends('sitelayout')
@section('title', 'Nolan Bowl XXXXI: Games')
@section('content')


<form method="post" action="{{ route('user.update', $user->id) }}">
          
@csrf
@method('PATCH')
              
<table >
    <tr>
        <th colspan="2">
        <table style="width: 100%" class="insideth">
<tr><th>Edit  {{$user->full_name}}</th><th><a style="float: right" href="{{ url()->previous() }}" ><i class="material-icons">undo</i></a></th></tr>
</table>
        </th>
    </tr>




<tr>
    <td ><label for="firstname" class="label col-md-4 col-form-label text-md-right">{{ __('Firstname') }}:</label></td></td><td><input id="firstname" type="text" class="textfield form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }}" name="firstname" value="{{ $user->firstname }}" required>
                    @if ($errors->has('firstname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('firstname') }}</strong>
                                    </span>
                     @endif   
                    

                </td>
            </tr>
            <tr>
                <td>
                    <label for="nickname" class="label col-md-4 col-form-label text-md-right">{{ __('Nickname') }}:</label></td>
                    <td><input id="nickname" type="text" class="textfield form-control{{ $errors->has('nickname') ? ' is-invalid' : '' }}" name="nickname" value="{{ $user->nickname }}" required autofocus>
                    @if ($errors->has('nickname'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('nickname') }}</strong>
                        </span>
                    @endif
                </td>
            </tr>              
              
            
            <tr>
                <td>
                    <label for="lastname" class="label col-md-4 col-form-label text-md-right">{{ __('Last Name') }}:</label></td>


                    <td><input id="lastname" type="text" class="textfield form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}" name="lastname" value="{{ $user->lastname }}" required>

                    @if ($errors->has('lastname'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('lastname') }}</strong>
                        </span>
                    @endif   
                    

                </td>
            </tr>
            <tr>
                <td>
                <label for="email" class="label col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}:</label></td>


                <td><input id="email" type="email" class="textfield form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $user->email }}" required>

                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif

                </td>
            </tr>  
              
            <tr>
                <td>
                    <label for="city" class="label col-md-4 col-form-label text-md-right">City:</label></td>
                    
                    <td> <input id="city" type="text" class="textfield" name="city" required value="{{$user->city}}">
                    @if ($errors->has('city'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                     @endif   
                
                </td>
            </tr>
            <tr>
                <td>
                    <label for="state" class="label col-md-4 col-form-label text-md-right">State (Abbreviation):</label></td>
                    
                    <td><input id="state" type="text" class="textfield" name="state" required value="{{$user->state}}">
                    @if ($errors->has('state'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('state') }}</strong>
                                    </span>
                     @endif   
                
                </td>
            </tr>
            <tr>
                <td>
                    <label for="bowling" class="label col-md-4 col-form-label text-md-right">Bowling Average:</label></td>
                    
                    <td><input id="bowling" type="text" class="textfield" name="bowling" required value="{{$user->bowling}}">
                    @if ($errors->has('bowl'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('bowling') }}</strong>
                                    </span>
                     @endif   
                
                </td>
            </tr>    



            <tr>
                <td colspan="2">
                    <label for="knowme" class="label col-md-4 col-form-label text-md-right">How do you know me?</label><br>

                    <textarea cols="50" rows="5" name="knowme" required >{{$user->knowme}}
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
                    <label for="cq1" class="label col-md-4 col-form-label text-md-right">{{ $cq1 }}</label><br>

                    <textarea cols="50" rows="5" name="cq1" required >{{$user->cq1}}
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

                    <textarea cols="50" rows="5" name="cq2" required >{{$user->cq2}}
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

                    <td><input id="favsport" type="text" class="textfield" name="favsport" required value="{{$user->favsport}}">
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

                    <textarea cols="50" rows="5" name="news" required >{{$user->news}}
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

                    <textarea cols="50" rows="5" name="smack" required >{{$user->smack}}
                    @if ($errors->has('smack'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('smack') }}</strong>
                                    </span>
                     @endif
                     </textarea>
                
                </td>
            </tr>


            @isadmin
            <tr>
                <td>
                    <label for="division" class="label col-md-4 col-form-label text-md-right">{{ __('Division') }}:</label></td>


                    <td><input id="division" type="text" class="textfield form-control{{ $errors->has('division') ? ' is-invalid' : '' }}" name="division" value="{{ $user->division }}" >

                    @if ($errors->has('division'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('division') }}</strong>
                        </span>
                    @endif   
                    

                </td>
            </tr>
            <tr>
                <td>
                    <label for="conference" class="label col-md-4 col-form-label text-md-right">{{ __('Conference') }}:</label></td>


                    <td><input id="conference" type="text" class="textfield form-control{{ $errors->has('conference') ? ' is-invalid' : '' }}" name="conference" value="{{ $user->conference }}" >

                    @if ($errors->has('conference'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('conference') }}</strong>
                        </span>
                    @endif   
                    

                </td>
            </tr>
            <tr>
                <td>
                    <label for="allscores" class="label col-md-4 col-form-label text-md-right">{{ __('All Time Scores') }}:</label></td>


                    <td><input id="allscores" type="text" class="textfield form-control{{ $errors->has('alltime') ? ' is-invalid' : '' }}" name="allscores" value="{{ $user->allscores }}" required>

                    @if ($errors->has('allscores'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('allscores') }}</strong>
                        </span>
                    @endif   
                    

                </td>
            </tr>
            <tr>
                <td>
                    <label for="nbi" class="label col-md-4 col-form-label text-md-right">{{ __('Nolan Bowl Index (NBI)') }}:</label></td>


                    <td><input id="nbi" type="text" class="textfield form-control{{ $errors->has('nbi') ? ' is-invalid' : '' }}" name="nbi" value="{{ $user->nbi }}" required>

                    @if ($errors->has('nbi'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('nbi') }}</strong>
                        </span>
                    @endif   
                    

                </td>
            </tr>
            <tr>
                <td>
                    <label for="divisionwins" class="label col-md-4 col-form-label text-md-right">{{ __('Division Wins') }}:</label></td>


                    <td><input id="divisionwins" type="text" class="textfield form-control{{ $errors->has('divisionwins') ? ' is-invalid' : '' }}" name="divisionwins" value="{{ $user->divisionWins }}" required>

                    @if ($errors->has('divisionwins'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('divisionwins') }}</strong>
                        </span>
                    @endif   
                    

                </td>
            </tr>
            <tr>
                <td>
                    <label for="coinflip" class="label col-md-4 col-form-label text-md-right">{{ __('Coin Flip (0 or 1)') }}:</label></td>


                    <td><input id="coinflip" type="text" class="textfield form-control{{ $errors->has('coinflip') ? ' is-invalid' : '' }}" name="coinflip" value="{{ $user->coinflip }}" required>

                    @if ($errors->has('coinflip'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('coinflip') }}</strong>
                        </span>
                    @endif   
                    

                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="tags" class="label col-md-4 col-form-label text-md-right">Tags (seperate with spaces):</label><br>

                    <textarea cols="50" rows="5" name="tags"  >{{$user->tags}}
                    @if ($errors->has('tags'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tags') }}</strong>
                                    </span>
                     @endif
                     </textarea>
                
                </td>
            </tr>
            <tr>
                <td>
                    <label for="status" class="label col-md-4 col-form-label text-md-right">{{ __('Status') }}:</label></td>


                    <td><input id="status" type="text" class="textfield form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" name="status" value="{{ $user->status }}" required>

                    @if ($errors->has('status'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('status') }}</strong>
                        </span>
                    @endif   
                    

                </td>
            </tr>
            @endisadmin
            <tr>
                <td colspan="2">
                <button type="submit" class="btn btn-block btn-danger">Update user</button>
                </td>
            </tr>


            </table>  
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
                        
      </form>

@endsection

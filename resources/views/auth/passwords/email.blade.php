@extends('welcomelayout')
@section('pagetitle', 'Reset your Nolanbowl Password') 
@section('content')




@if(session('status'))

<div id="message">


<table class="table">
  <tr>
    <th>Message Box</th>
  </tr>
  <tr>
    <td>{{ session('status') }}</td>
  </tr>
</table>
<p>

</div>

<script type="text/javascript">
setTimeout(() => {
    const elem = document.getElementById("message");
    elem.parentNode.removeChild(elem);
}, 5000);


</script>


@endif
<form method="POST" action="{{ route('password.email') }}">
@csrf

<table >                    
    <tr>
        <th colspan="2">Reset your password...</th>
    </tr>
    <tr>
        <td><label class="label">Email:</td>
        <td><input id="email" type="email" class="textfield form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required></td>
    </tr>
    <tr>
        <td colspan="2"><button type="submit" >{{ __('Send Password Reset Link') }}</button></td>
    </tr>



    
</table>

@endsection

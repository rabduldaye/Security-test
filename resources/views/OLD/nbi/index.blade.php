@extends('testLayout')

@section('content')

<style>
  .push-top {
    margin-top: 50px;
  }
</style>

<div class="push-top">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}
    </div><br />
  @endif

  @isadmin
  <table class="headerTable">
    <td><a href="{{ route('nbi.create')}}" class="btn btn-primary btn-sm">New Participant</a></td>
  </table>
  @endisadmin
  <table class="table">
    <thead>
        <tr class="table-warning">
          
          <td>Participant</td>
          
          <td>NBI RAW</td>
        
        </tr>
    </thead>
    <tbody>

        @foreach($nbi as $nbi)
        <tr>
            
            <td>{{$nbi->nickname}}</td>
        
            <td>{{$nbi->nbiraw}}%</td>
            <td class="text-center">
                <a href="{{ route('nbi.edit', $nbi->id)}}" class="btn btn-primary btn-sm">Edit</a>
                <form action="{{ route('nbi.destroy', $nbi->id)}}" method="post" style="display: inline-block">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                  </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
@endsection

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
  <table class="headerTable">
    <td><a href="{{ route('alltimerank.create')}}" class="btn btn-primary btn-sm">All Time Rankers</a></td>
  </table>
  <table class="table">
    <thead>
        <tr class="table-warning">
          <td>Name</td>
          <td>Points</td>
          <td>Rank</td>
          
        </tr>
    </thead>
    <tbody>
        @foreach($alltimerank as $alltimerank)
        <tr>
            <td>{{$alltimerank->name}}</td>
            <td>{{$alltimerank->points}}</td>
            <td>{{$alltimerank->rank}}</td>
            <td class="text-center">

                  </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
@endsection

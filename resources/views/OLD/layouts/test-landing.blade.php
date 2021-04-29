
@extends('layout')

@section('content')

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">NolanBowl XX</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">

  
    <ul class="navbar-nav mr-auto">
    @if (auth('admin'))
      <li class="nav-item active">
        <a href="{{ route('user.index')}}" class="nav-link">Profiles<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a href="{{ route('games.index')}}" class="nav-link">Games</a>      
      </li>
      <li class="nav-item active">
        <a href="{{ route('conference.index')}}" class="nav-link">Conferences</a>      
      </li>
      <li class="nav-item active">
        <a href="{{ route('division.index')}}" class="nav-link">Divisions</a>      
      </li>
      @endif
      <li class="nav-item active">
        <a href="{{ route('nbi.index')}}" class="nav-link">NBI</a>      
      </li>
      
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>
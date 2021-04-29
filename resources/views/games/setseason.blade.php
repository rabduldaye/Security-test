@extends('testLayout')

@section('content')

<style>
    .container {
      max-width: 450px;
    }
    .push-top {
      margin-top: 50px;
    }
</style>

<div class="card push-top">
  <div class="card-header">
    Season Reset
  </div>
  <table class="headerTable">
    <td><a href="{{route('games.index')}}">Back To Games</a></td>
    </table>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('games.store') }}">
          <div class="form-group">
              @csrf
          </div>
          <div class="form-group">
            <p>Files has been reset:<p>           
              
              <?php
                $servername = "localhost";
                $username = "homestead";
                $password = "secret";
                $dbname = "homestead";
                
                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                  die("Connection failed: " . $conn->connect_error);
                }
                
                $result = "DELETE FROM games";

                  if ($conn->query($result) === TRUE) {
                    echo "Record deleted successfully";
                  } else {
                    echo "Error deleting record: " . $conn->error;
                  }
                  
                  $conn->close();
                  ?>
        </form>
  </div>
</div>
@endsection
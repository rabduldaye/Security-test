@extends('sitelayout')

@section('pagetitle', ': User Sorter') 
@section('content')



<form action="{{ route('user.adduser2div')}}" method="post" >
    @csrf
    
<table class="table" ng-app="myApp" ng-controller="myCtrl">
<tr class="table-warning">
          
          <th>Full Name</td>
          
          <th>Location</td>
          <th>Add to division?</td>
          
</tr>
<tr>
    <td><input class="textfield" type="text" name="whatever" value="" ng-model="name"></td>
    <td><input class="textfield" type="text" name="whatever1" value="" ng-model="locale"></td>
    <td>
               <input type="submit" value="Add User(s) to">
                <select name="division">
                @foreach($divs as $division)
                    <option value="{{ $division->name }}">{{ $division->name }}</option>
                @endforeach
                </select>
                
            
  </td>
</tr>
  

       
<tr ng-repeat="user in users | filter: { full_name: name } | filter: { location: locale }">
          <td>[[ user.full_name ]]</td>
          <td>[[ user.location ]]</td>
          <td><input name="user[[user.id ]]" value="[[user.id ]]" type="checkbox"></td>
            
            
        </tr>
        








</table>
      

</form>

   
        
       

<script>
  var app = angular.module('myApp', []);
  app.controller('myCtrl', function($scope, $http) {
    //set js array to json array of blade profile
    $scope.users = @json($users);
    
}).config(function($interpolateProvider){
        $interpolateProvider.startSymbol('[[').endSymbol(']]');
      });;
</script>

@endsection

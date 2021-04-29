@extends('sitelayout')

@section('pagetitle', ': Create Conference') 
@section('content')

<form method="post" action="{{ route('conference.store') }}">
    @csrf
    
<table>

  <tr>
    <th>Create Conference</th><th><a style="float: right" href="/conference"><i class="material-icons">undo</i></a>
    <a style="float: right; cursor:pointer;" onclick="addConference()" ><i class="material-icons">vertical_align_bottom</i></a></th>
  </tr>
  <tr id="confEntry">
    <td><label class="label">Name:</label></td>
    <td><input type="text" class="textfield"  name="conference" /></td>
  </tr>
  <tr id="endConfEntries">
    <td colspan="2"><button type="submit" class="btn btn-block btn-danger">Create Conference(s)</button></td>
  </tr>
</table>
      

</form>





    <script type="text/javascript">

//need a counter (each field needs a unique identifier)
var counter = 1;

function setNames(field) {
  //set names of all fields
  var fields = field.childNodes;

  if (fields) {
  for (var i=0;i<fields.length;i++) {
    console.log(fields[i]);
    //get the name field
    var theName = fields[i].name
    //if the name field isn't empty
    if (theName) {
      //append the counter to it
      fields[i].name = theName + counter;
    } else {
      //not an field with a nmae, so crack it open
      setNames(fields[i]);
    }
  }
  }


}


function addConference() {
  counter++;
  var newFields = document.getElementById('confEntry').cloneNode(true);
  //reset the id
  newFields.id = '';
  //get the child nodes
  
  //loop through them
  setNames(newFields);
  //get the where
  var insertHere = document.getElementById('endConfEntries');
  //actually insert it
  insertHere.parentNode.insertBefore(newFields, insertHere);

  
  

}







</script>








@endsection
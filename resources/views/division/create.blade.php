@extends('sitelayout')

@section('pagetitle', ': Divisions') 
@section('content')


<table>

  <tr>
    <th>Create Divisions</th><th><a style="float: right" href="/division"><i class="material-icons">undo</i></a>
    <a style="float: right; cursor:pointer;" onclick="addDivision()" ><i class="material-icons">vertical_align_bottom</i></a></th>
  </tr>
  <form method="post" action="{{ route('division.store') }}">
  @csrf
  <tr id="divisionEntry">
      <td ><label for="name" class="label ">Name:</label><input type="text" class="textfield" name="division"/></td>

      <td><select name="conference">
                  @foreach ($conferences as $conference)
                    <option value="{{ $conference->name }}">{{ $conference->name }}</option>
                 @endforeach
               </select></td>
    </tr>
    <tr id="endDivisionEntries">
      <td colspan="2"><button type="submit" class="btn btn-block btn-danger">Add Divisions</button></td>
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


    function addDivision() {
      counter++;
	    var newFields = document.getElementById('divisionEntry').cloneNode(true);
      //reset the id
      newFields.id = '';
	    //get the child nodes
      
      //loop through them
      setNames(newFields);
      //get the where
      var insertHere = document.getElementById('endDivisionEntries');
      //actually insert it
      insertHere.parentNode.insertBefore(newFields, insertHere);

      
      

    }



    

    

</script>

@endsection



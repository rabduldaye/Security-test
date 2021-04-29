@extends('sitelayout')
@section('pagetitle', ': Send Email') 
@section('content')

<script type="text/javascript">





function setNames(field, newname) {
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
			      fields[i].name = newname;
          } else {
            //not an field with a nmae, so crack it open
            setNames(fields[i]);
          }
	      }
      }

    }
function myFunction() {
  // Get the checkbox
  var checkBox = document.getElementById("sendActionButton");
  //get the element to add or remove
  

  // If the checkbox is checked, display the output text
  if (checkBox.checked == true){
    //get the element to add to:
    var before = document.getElementById("inserthere");
    var text = document.getElementById("addafter").cloneNode(true);
    setNames(text, "messageAfter");
    
    //alert();
    text.childNodes[1].childNodes[0].innerHTML = "Message (after button):"; 
    text.id = 'inserted';


   

    text.childNodes[1].childNodes[3].name = "addafter";
    text.childNodes[1].childNodes[3].required  = false;
    //add the element
    before.parentNode.insertBefore(text, before);

    


  } else {
    //get the inserted
    var text = document.getElementById("inserted");
    //and remove it
    text.parentNode.removeChild(text);
  }
}
</script>


<form method="post" action="{{ route('send') }}">@csrf
<table class="main" id="parent">
  <tr>
    <th colspan="2">Send Email</th> 
  </tr>          
    <tr>
      <td colspan="2"><label class="label"> To: </label><br>
      <select class="select" name="to">
          <option value="myself" selected>Myself (test)</option>
          <option value="viewemail">View Email</option>
          <option value="everyone">Everyone</option>
          <option value="current">Current Players</option>
          <option value="missing">Missing Picks</option>
</select></td>
  <tr>
    <td colspan="2">
      <label class="label">Subject:</label><br>
     <input type="text" class="textfield" name="subject" required><p>
      
    </td>
        
    </tr>
    <tr>
    <td colspan="2">
      <label class="label">Send Link with Action Button?:</label><br>
      <input name="sendButtonCheck" type="checkbox" id="sendActionButton" onclick="myFunction()"><p>
      <label class="label">Send Link to where? </label><br><input type="text" class="textfield" name="link"><p>
      <label class="label">Button Text? </label><br><input type="text" class="textfield" name="actionLink"><p>
      
    </td>
        
    </tr>
    <tr id="addafter">
    <td style="padding: 10px 10px 10px 10px; width: 99%; " colspan="2"><label class="label" >Message (before button): </label><br>
      
      <textarea style="width: 99%; " rows=20 name="message" required></textarea></td>
    </tr>
    
    <tr id="inserthere">
      <td colspan="2"><button type="submit" class="btn btn-block btn-danger">Send Email</button></td>
  </tr>


</table>
</form>     
       
 



@endsection
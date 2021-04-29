@extends('sitelayout')

@section('pagetitle', ': Edit Tag') 
@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                      

<table>

  <tr>
    <th>Edit Division</th><th><a style="float: right" href="/division"><i class="material-icons">undo</i></a></th>
  </tr>

  <form method="post" action="{{ route('division.update', $division->id) }}">
    @csrf
    @method('PATCH')
    <tr>
      <td ><label for="name" class="label ">Name:</label></td>
      <td><input type="text" class="textfield" name="name" value="{{$division->name}}" />
      
      </td>
    </tr>
    <tr>
      <td><label for="name" class="label ">Conference:</label></td>
      <td><select name="conference">
                  @foreach ($conferences as $conference)
                    @if ($division->conference == $conference->name)
                      <option selected value="{{ $conference->name }}">{{ $conference->name }}</option>
                    @else
                      <option value="{{ $conference->name }}">{{ $conference->name }}</option>
                    @endif
                 @endforeach
               </select></td>
    </tr>
    </tr>
    <tr>
      <td colspan="2"><button type="submit" class="btn btn-block btn-danger">Edit Division</button></td>
    </tr>
    </form>
</table>

    

@endsection








<!--
      
          <div class="form-group">
              @csrf
              @method('PATCH')
              <label for="id">id</label>
              <input type="text" class="form-control" name="id" value="{{ $division->id }}"/>
          </div>
          <div class="form-group">
              <label for="name">name</label>
              <input type="text" class="form-control" name="name" value="{{ $division->name }}"/>
          </div>
          <button type="submit" class="btn btn-block btn-danger">Update division</button>

      </form>
  </div>
</div>

--->
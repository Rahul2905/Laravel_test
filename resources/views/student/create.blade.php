@extends('layout.app')
@section('content')
<div class="row">
  <div class="col-md-6 col-md-offset-3">

    <div class="box box-primary">
      <br/><br/>
      <div class="box-header with-border">
        <h3 class="box-title">Create Student</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form role="form" action="{{route('student.store')}}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        
        <div class="box-body">
          <div class="form-group">
            <label for="name">Select Parent</label>
            <select class="form-control" name="pid">
              <option value=""> select </option>
               <option value="0">Parent</option>
               <?php echo $optionlist; ?>
              
            </select>
            <span class="text-danger">{{ $errors->first('pid') }}</span>
          </div>

          <div class="form-group">
            <label for="name">First Name</label>
            <input type="text" class="form-control" name="fname" placeholder="First Name" value="{{ old('fname') }}">
            <span class="text-danger">{{ $errors->first('fname') }}</span>
          </div>

          <div class="form-group">
            <label for="name">Last Name</label>
            <input type="text" class="form-control" name="lname" placeholder="Last Name" value="{{ old('lname') }}">
            <span class="text-danger">{{ $errors->first('lname') }}</span>
          </div>
        </div>
        <!-- /.box-body -->

        <div class="box-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
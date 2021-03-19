@extends('layout.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
	    <div class="col-md-12">
	    <a href="student/create" class="btn btn-primary mb-2">Create Student</a> 
        <br>
        
        @if(Session::has('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">×</button>
            {{Session::get('success')}}
        </div>
    	@endif

    	@if(Session::has('error'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">×</button>
            {{Session::get('error')}}
        </div>
    	@endif
	    	<ul>	
		    @foreach($Pstudent as $stu)
		 		
			 <li> 
			 	<span>{{$stu->fname}}&nbsp;{{$stu->lname}}</span>
			 	<a class="btn btn-sm"  href="student/{{$stu->id}}/edit" title="edit category">&#9998;</a>
			 	<form action="student/{{$stu->id}}" method="post" class="d-inline">
                    {{ csrf_field() }}
                    @method('DELETE')
                    <input  type="submit" value="&#x1F5D1;" />
                </form>

			  @if(count($stu->substudent))
			    @include('student.substudent',['substudent' => $stu->substudent])
			  @endif
			</li>
		 
		@endforeach
		</ul>
		</div>

	</div>
</div>
@endsection
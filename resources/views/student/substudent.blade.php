
@foreach($substudent as $stud)
 <ul>
    <li>{{$stud->fname}}&nbsp;{{$stud->lname}}
    	&nbsp; 
	 	<a class="btn btn-sm"  href="student/{{$stud->id}}/edit" title="edit student">&#9998;</a>
	 	<form action="student/{{$stu->id}}" method="post" class="d-inline">
            {{ csrf_field() }}
            @method('DELETE')
            <input  type="submit" value="&#x1F5D1;" />
        </form>
    </li> 
  @if(count($stud->substudent))
    @include('student.substudent',['substudent' => $stud->substudent])
  @endif
 </ul> 
@endforeach

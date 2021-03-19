<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Pstudent = Student::where('pid',0)->get();
        return view('student.index', compact('Pstudent'));
    }
    # function for levelwise optionlist
    protected function studentlist($pid , $str='' , $selected='',$editid='') {
        $optionlist = '';
        $student = Student::where('pid',$pid)->get();

        foreach ($student as $s) { 
            $dis = ($editid != '' && $editid == $s->id) ? 'disabled' : '';
            

            if ($selected == $s->id) {
                $optionlist .= "<option value='".$s->id."' selected  $dis >$str $s->fname $s->lname</option>";
            } else {
                $optionlist .= "<option value='".$s->id."' $dis >$str $s->fname $s->lname</option>";
            }

            if (count($s->substudent)) {
                $str1 = $str.'-';
                $optionlist .= $this->studentlist($s->id,$str1,$selected,$editid);
            }
        }
        return $optionlist;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['optionlist'] = $this->studentlist(0,'-');
        return view('student.create',$data);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
            'fname'         =>  'required|max:50',
            'lname'         =>  'required|max:50',
            'pid'           =>  'required|not_in:-1'
            ],
            [
            'fname.required' => 'Fisrt name is required field',
            'lname.required' => 'Last name is required field',
            'pid.not_in'   => 'selected value is not appropriate',
            ]

        );

        Student::create($request->all());

        return redirect('student')->with('success', 'Student Added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $where = ['id' => $id];
        $data['student'] = Student::where($where)->first();
        $pid = $data['student']['pid'];
        $data['optionlist'] = $this->studentlist(0,'-',$pid, $id);
        return view('student.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, student $student)
    {
        $request->validate(
            [
            'fname'         =>  'required|max:50',
            'lname'         =>  'required|max:50',
            'pid'           =>  'required|not_in:-1'
            ],
            [
            'fname.required' => 'Fisrt name is required field',
            'lname.required' => 'Last name is required field',
            'pid.not_in'   => 'selected value is not appropriate',
            ]

        );

        $student->update($request->all());

        return redirect('student')->with('success', 'Student updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $where = ['id' => $student->id];
        $stud = Student::where($where)->first();

        if (count($stud->substudent) > 0) {
            return redirect()->route('student.index')
            ->with('error', 'Student can not deleted as found parent for other student.');
        } else {
            $student->delete();
        }
        return redirect()->route('student.index')
            ->with('success', 'Product deleted successfully');
    }
}

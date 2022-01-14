<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function SaveStudent()
    {
        $student = new Student;

        $student->name = request()->name;
        $student->email = request()->email;
        $student->phone = request()->phone;

        $student->save();

        return 'Ok';
        
    }

    public function AllStudents()
    {
        $students = Student::paginate(5);

        return response()->json($students);
    }

    public function EditStudent($id)
    {
        $student = Student::find($id);

        return response()->json($student);
    }

    public function UpdateStudent()
    {
        $student = Student::find(request()->id);

        $student->name = request()->name;
        $student->email = request()->email;
        $student->phone = request()->phone;

        $student->save();

        return 'Test';

    }

    public function DeleteStudent($id)
    {
        Student::find($id)->delete();

        return 'Ok';
    }
}

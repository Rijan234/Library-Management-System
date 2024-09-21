<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Student;
use Illuminate\Http\Request;
use PHPUnit\Framework\MockObject\Builder\Stub;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::all();
        return view('student.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $faculties = Faculty::all();
        
        return view('student.create', compact('faculties'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $student = new Student();
        $student->name = $request->student_name;
        $student->address = $request->address;
        $student->father_name = $request->father_name;
        $student->phone = $request->phone;
        $student->faculty_id= $request->faculty;

        $student->save();
        return redirect()->route('student.index')->with('success', 'Student created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $student = Student::find($id);
        $faculties = Faculty::all();
        $selectedFacultyId = $student->faculty_id;

        return view('student.edit', compact('student', 'faculties','selectedFacultyId'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $student =  Student::find($id);
        $student->name = $request->student_name;
        $student->address = $request->address;
        $student->father_name = $request->father_name;
        $student->phone = $request->phone;
        $student->faculty_id= $request->faculty;

        $student->update();
        return redirect()->route('student.index')->with('success', 'Student updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = Student::find($id);
        $student->delete();    
            return redirect()->route('student.index')->with('delete', 'Student deleted successfully.');


    }
}

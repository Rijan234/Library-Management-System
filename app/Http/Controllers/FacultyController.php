<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use Illuminate\Http\Request;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faculties = Faculty::all();
        return view('faculty.index', compact('faculties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('faculty.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $faculty = new Faculty();
        $faculty->name = $request->faculty_name;
        $faculty->save();

        return redirect()->route('faculty.index')->with('success', 'Faculty created successfully.');
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
        $faculty = Faculty::find($id);
        return view('faculty.edit', compact('faculty'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $faculty = Faculty::find($id);
        $faculty->delete();
       
        return redirect()->route('faculty.index')->with('delete', 'Faculty deleted successfully.');
    }
}

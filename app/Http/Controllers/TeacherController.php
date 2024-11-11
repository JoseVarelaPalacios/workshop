<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Country;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class TeacherController extends Controller
{
    
    public function index()
    {
        $countries = Country::all();
        $teachers = Teacher::with('country:id,country','courses:name')->get();
        return Inertia::render('Teachers/Index',[
            'teachers' =>$teachers,
            'countries' =>$countries
         ]);
    }

    
    public function create()
    {
        
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|max:80',
            'last_name'=>'required|max:80',
            'country_id'=>'required|numeric'
        ]);
        $teacher = new Teacher ($request->input());
        $teacher->save();
        return redirect('teachers');
    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        //
    }

    
    public function edit(Teacher $teacher)
    {
       
    }

    
    public function update(Request $request, Teacher $teacher)
    {
        $request->validate([
            'name'=>'required|max:80',
            'last_name'=>'required|max:80',
            'country_id'=>'required|numeric'
        ]);
        $teacher -> update($request->input());
        return redirect ('teachers');
    }

   

    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        return redirect('teachers');
    }
}

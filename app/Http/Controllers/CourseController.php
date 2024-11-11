<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Course;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class CourseController extends Controller
{
    
    public function index()
    {
        return Inertia::render('Courses/Index',[
            'courses' => Course::paginate(10)
        ]);
    }

    

    public function create()
    {
        return Inertia::render('Courses/Create', [
            'teachers' => Teacher::all()
        ]);
    }

    

    public function store(Request $request)
    {
        $request->validate([
            'duration' => 'required|max:100',
            'description' => 'required|max:250',
            'name' => 'required|max:100', 
            'mode' => 'required|max:50',
            'start_date' => 'required|date',
            'finish_date' => 'required|date',
            'cost' => 'required|numeric',
            'image' => 'required|file|mimes:png,jpg,gif',
            'teachers' => 'required|array'
        ]);

        $course = Course::create($request->all());

        if ($request->hasFile('image')) {
            $imgName = microtime(true) . '.' . $request->file('image')
            ->getClientOriginalExtension();
            $request->file('image')->storeAs('img', $imgName, 'public');
            $course->image = '/img/' . $imgName;
            $course->save();
        }
        $course->teachers()->sync($request->teachers);
        return redirect('courses/create')->with('success','Course created');
    }
    public function updateCourse(Request $request){
        $request->validate([
            'duration' => 'required|max:100',
            'description' => 'required|max:250',
            'name' => 'required|max:100', 
            'mode' => 'required|max:50',
            'start_date' => 'required|date',
            'finish_date' => 'required|date',
            'cost' => 'required|numeric',
            'id' => 'required|numeric',
            'teachers' => 'required|array'
        ]);

        $course = Course::find($request->id);
        $course->update($request->input());
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($course->image);
            $imgName = microtime(true) . '.' . $request->file('image')
            ->getClientOriginalExtension();
            $request->file('image')->storeAs('img', $imgName, 'public');
            $course->image = '/img/' . $imgName;
            $course->save();
        }
        $course->teachers()->sync($request->teachers);
        return redirect('courses')->with('success','Course updated');
    }
    

    public function show(Course $course)
    {
        return Inertia::render('Courses/Show',[
            'course' => $course, 'teachers' => $course -> teachers
        ]);

    }

    

    public function edit(Course $course)
    {
        return Inertia::render('Courses/Edit', [
            'teachers' => Teacher::all(),
            'course' => $course,
            'teachersOfCourse' => $course->teachers
        ]);
    }

    

    public function update(Request $request, Course $course)
    {
        //
    }

    

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect('courses')->with('success','Course deleted');
    }
}

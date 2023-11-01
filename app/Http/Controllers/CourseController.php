<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Inertia\Inertia;

class CourseController extends Controller
{
    // Display a listing of the courses
    public function index(): \Inertia\Response
    {
        $courses = Course::all();
        return Inertia::render('Courses/Index', [
            'courses' => $courses,
        ]);
    }

    // Show the form for creating a new course
    public function create(): View
    {
        return view('courses.create');
    }

    // Store a newly created course in the database
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'days' => 'integer',
            'hours' => 'integer',
        ]);

        Course::create($request->all());

        return redirect()->route('courses.index')
            ->with('success', 'Course created successfully');
    }

    // Display the specified course
    public function show(Course $course): View
    {
        return view('courses.show', compact('course'));
    }

    // Show the form for editing the specified course
    public function edit(Course $course): View
    {
        return view('courses.edit', compact('course'));
    }

    // Update the specified course in the database
    public function update(Request $request, Course $course): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'days' => 'integer',
            'hours' => 'integer',
        ]);

        $course->update($request->all());

        return redirect()->route('courses.index')
            ->with('success', 'Course updated successfully');
    }

    // Remove the specified course from the database
    public function destroy(Course $course): JsonResponse
    {
        $course->delete();

        return response()->json([], 204);
    }

}

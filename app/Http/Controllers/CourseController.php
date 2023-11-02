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
            'createRoute' => route('courses.create')
        ]);
    }

    // Show the form for creating a new course
    public function create(): \Inertia\Response
    {
        return Inertia::render('Courses/Create', [
            'createRoute' => route('courses.create'),
            'csrfToken' => csrf_token(),
        ]);
    }

    // Show the form for editing the specified course
    public function edit(Course $course): \Inertia\Response
    {
        return Inertia::render('Courses/Edit', [
            'course' => $course
        ]);
    }
    // Store a newly created course in the database

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'days' => 'integer',
            'hours' => 'integer',
        ]);

        Course::create($request->all());

        return response()->json(['message' => 'Course created successfully'], 201);
    }

    // Display the specified course

    public function show(Course $course)
    {
        // TODO
        //return view('courses.show', compact('course'));
    }

    // Update the specified course in the database
    public function update(Request $request, Course $course): JsonResponse
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'days' => 'integer',
            'hours' => 'integer',
        ]);

        $course->update($request->all());

        return response()->json(['message' => 'Course updated successfully'], 201);
    }

    // Remove the specified course from the database
    public function destroy(Course $course): JsonResponse
    {
        $course->delete();

        return response()->json([], 204);
    }

}

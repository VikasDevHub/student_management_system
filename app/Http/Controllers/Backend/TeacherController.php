<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $teachers = Teacher::orderBy('name')->get();
            return view('backend.teachers.list',
            ['teachers' => $teachers]);
        }catch (\Exception $e)
        {
            // When view not found
            return redirect()->route('page-not-found');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('backend.teachers.create');
        }catch (\Exception $e)
        {
            // When view not found
            return redirect()->route('page-not-found');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|min:2',
                'email' => 'required|email|unique:teachers,email',
                'password' => 'required|string|min:8',
                'profile_image' => 'required|image|mimes:jpg,png,jpeg,webp|max:5120',
                'address' => 'nullable|string|max:255',
                'phone_no' => 'nullable|string|max:15',
                'city' => 'nullable|string|max:100',
                'tel' => 'nullable|string|max:100',
                'dist' => 'nullable|string|max:100',
                'zipcode' => 'nullable|string|max:10',
            ]);

            if ($validator->fails()) {
                return redirect()->route('teachers.create')
                    ->withInput()
                    ->withErrors($validator);
            }

            // Get validated data
            $data = $validator->validated();

            // Handle profile image upload
            if ($request->hasFile('profile_image')) {
                $file = $request->file('profile_image');
                $filename = time(). '-' .$file->getClientOriginalName();

                // Define the destination path
                $destinationPath = public_path('backend/uploads/teachers/profile-images');

                // Move the file to the destination path
                $file->move($destinationPath, $filename);

                // Store the filename in the database
                $data['profile_image'] = $filename;
            }

            // let's make password hash before storing to db
            $data['password'] = Hash::make($data['password']);

            // Create the teacher record
           Teacher::create($data);

            return redirect()->route('teachers.index')->with('success', 'Teacher created successfully.');

        } catch (\Exception $e) {
//            Log::error('Error occurred while creating teacher: ' . $e->getMessage());
            return redirect()->route('teachers.create')
                ->with('error', 'An error occurred. Please try again.');
        }
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
        try {
            $teacher = Teacher::findOrFail($id);
            return view('backend.teachers.edit',[
                'teacher' => $teacher
            ]);
        }catch (\Exception $e)
        {
            // When view not found
            return redirect()->route('page-not-found');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|min:2',
                'email' => 'required|email|unique:teachers,email,' . $id,
                'profile_image' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:5120',
                'address' => 'nullable|string|max:255',
                'phone_no' => 'nullable|string|max:15',
                'city' => 'nullable|string|max:100',
                'tel' => 'nullable|string|max:100',
                'dist' => 'nullable|string|max:100',
                'zipcode' => 'nullable|string|max:10',
            ]);

            if ($validator->fails()) {
                return redirect()->route('teachers.edit', $id)
                    ->withInput()
                    ->withErrors($validator);
            }

            // Get validated data
            $data = $validator->validated();

            // Find the existing teacher record
            $teacher = Teacher::findOrFail($id);
            $oldImage = $teacher->profile_image;
            $path = 'backend/uploads/teachers/profile-images';

            // Handle profile image upload
            if ($request->hasFile('profile_image')) {
                $file = $request->file('profile_image');
                $filename = time().'-' . $file->getClientOriginalName();

                // Define the destination path
                $destinationPath = public_path($path);

                // Move the file to the destination path
                $file->move($destinationPath, $filename);

                // Remove the image if new is uploade successfully
                if($oldImage && File::exists(public_path($oldImage))){
                    File::delete(public_path($oldImage));
                }


                // Store the filename in the database
                $data['profile_image'] = $filename;
            }

            // let's make password hash before storing to db if password is provided
            if ($request->filled('password')) {
                $data['password'] = Hash::make($data['password']);
            }

            // Update the teacher record
            $result = $teacher->update($data);

            if(!$result){
                return redirect()->route('teachers.index')->with('error', 'Teacher not updated.');
            }

            return redirect()->route('teachers.index')->with('success', 'Teacher updated successfully.');

        } catch (\Exception $e) {
            Log::error('Error occurred while updating teacher: ' . $e->getMessage());
            return redirect()->route('teachers.edit', $id)
                ->with('error', 'An error occurred. Please try again.');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $teacher = Teacher::find($id);

        if (!$teacher) {
            return response()->json(['status' => 404, 'message' => 'Teacher not found']);
        }

        $teacher->delete();
        return response()->json(['status' => 200, 'message' => 'Teacher deleted successfully']);
    }

}

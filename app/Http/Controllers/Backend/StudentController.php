<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $students = Student::orderBy('name')->get();
            return view('backend.students.list', compact('students'));
        }catch (\Exception $e){
//            \Log::error('view error student'. $e->getMessage() . $e->getTrace());
            return view('backend.error-pages.error-404');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('backend.students.create');
        }catch (\Exception $e){
//            \Log::error('view error student'. $e->getMessage() . $e->getTrace());
            return view('backend.error-pages.error-404');
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
                    'email' => 'required|email|unique:students,email',
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
                return redirect()->route('students.create')
                    ->withInput()
                    ->withErrors($validator);
            }

            // Get validated data
            $data = $validator->validated();

            // let's make password has
            $data['password'] = Hash::make($data['password']);

            // let's upload image
            if($request->hasFile('profile_image')){
                $file = $request->file('profile_image');
                $fileName = time() .'-'. $file->getClientOriginalName();
                $path = public_path('backend/uploads/students/profile-images');
                $file->move($path,$fileName);

                // store to filename db
                $data['profile_image'] = $fileName;
            }

            // Create the teacher record
            Student::create($data);

            return redirect()->route('students.index')->with('success', 'Student created successfully.');

        }catch(\Exception $e){
            \Log::error('store error student'. $e->getMessage());
            return redirect()->route('students.create')
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
            $student = Student::findOrFail($id);
            return view('backend.students.edit', compact('student'));
        }catch (\Exception $e){
            \Log::error('view error student'. $e->getMessage());
            return view('backend.error-pages.error-404');
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
                'email' => 'required|email|unique:students,email,'.$id,/*
                'password' => 'nullable|string|min:8',*/
                'profile_image' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:5120',
                'address' => 'nullable|string|max:255',
                'phone_no' => 'nullable|string|max:15',
                'city' => 'nullable|string|max:100',
                'tel' => 'nullable|string|max:100',
                'dist' => 'nullable|string|max:100',
                'zipcode' => 'nullable|string|max:10',
            ]);

            if ($validator->fails()) {
                return redirect()->route('students.edit',$id)
                    ->withInput()
                    ->withErrors($validator);
            }

            // Get validated data
            $data = $validator->validated();

            $student = Student::findOrFail($id);

            // let's upload image
            if($request->hasFile('profile_image')){
                $file = $request->file('profile_image');
                $fileName = time() .'-'. $file->getClientOriginalName();
                $path = public_path('backend/uploads/students/profile-images');
                $file->move($path,$fileName);

                // store to filename db
                $data['profile_image'] = $fileName;

                // remove old image
                $oldProfileImage = $student->profile_image;
                $oldImagePath = $path .'/' . $oldProfileImage;

                // Make sure the oldProfileImage is not empty
                if ($oldProfileImage) {
                    // Check if the old image exists and delete it using unlink
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
            }

            // let's make password hash before storing to db if password is provided
            if ($request->filled('password')) {
                $data['password'] = Hash::make($data['password']);
            }

            // Update the teacher record
            $result = $student->update($data);

            if(!$result){
                return redirect()->route('students.index')->with('error', 'Student not updated.');
            }
            return redirect()->route('students.index')->with('success', 'Student updated successfully.');

        }catch(\Exception $e){
            \Log::error('update error student'. $e->getMessage());
            return redirect()->route('students.edit',$id)
                ->with('error', 'An error occurred. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json(['status' => 404, 'message' => 'Student not found']);
        }

        $student->delete();
        return response()->json(['status' => 200, 'message' => 'Student deleted successfully']);
    }
}

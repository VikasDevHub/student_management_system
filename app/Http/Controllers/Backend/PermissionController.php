<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $permissions = Permission::orderBy('created_at', 'DESC')->get();
            return view('backend.permissions.list', compact('permissions'));

        } catch (\Exception $e){
            return view('backend.error-pages.error-404');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('backend.permissions.create');

        } catch (\Exception $e){
            return view('backend.error-pages.error-404');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
           'name' => 'required|min:2|unique:permissions'
        ]);

        if($validator->fails()) {
            return redirect()->route('permissions.create')->withInput()->withErrors($validator);
        }

        $data = $validator->validated();
        $permission = Permission::create($data);

        if(!$permission) {
            return redirect()->route('permissions.index')->with('error', 'Something went wrong try again!');
        }
        return redirect()->route('permissions.index')->with('success', 'Permission is created successfully!');
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
            $permission = Permission::findOrFail($id);
            if(!$permission){
                return route('permissions.index');
            }
            return view('backend.permissions.edit', compact('permission'));

        } catch (\Exception $e){
            return view('backend.error-pages.error-404');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|min:2|unique:permissions,name,'.$id.',id'
        ]);

        if($validator->fails()) {
            return redirect()->route('permissions.edit',$id)->withInput()->withErrors($validator);
        }

        $data = $validator->validated();
        $permission = Permission::findOrFail($id);

        if(!$permission) {
            return redirect()->route('permissions.index')->with('error', 'Permission not Found');
        }

        $permission->update($data);
        return redirect()->route('permissions.index')->with('success', 'Permission is updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $permission = Permission::find($id);

        if (!$permission) {
            return response()->json(['status' => 404, 'message' => 'Permission not found']);
        }

        $permission->delete();
        return response()->json(['status' => 200, 'message' => 'Permission deleted successfully']);
    }
}

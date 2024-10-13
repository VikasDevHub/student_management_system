<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $roles = Role::orderBy('created_at', 'DESC')->get();
            return view('backend.roles.list', compact('roles'));

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
            $permissions = Permission::orderBy('name', 'ASC')->get();
            return view('backend.roles.create', compact('permissions'));

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
            'name' => 'required|min:2|unique:roles'
        ]);

        if($validator->fails()) {
            return redirect()->route('roles.create')->withInput()->withErrors($validator);
        }

        $data = $validator->validated();
        $role = Role::create($data);

        if(!$role) {
            return redirect()->route('roles.index')->with('error', 'Something went wrong try again!');
        }

        if(!empty($request->permission)) {
            // let's assign permissions to a role
            foreach ($request->permission as $name) {
                $role->givePermissionTo($name);
            }
        }
        return redirect()->route('roles.index')->with('success', 'Role is created successfully!');
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
            $role = Role::findOrFail($id);
            $hasPermissions = $role->permissions->pluck('name');
            $permissions = Permission::orderBy('name', 'ASC')->get();
            return view('backend.roles.edit', compact('permissions', 'role', 'hasPermissions'));

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
            'name' => 'required|min:2|unique:roles,name,'.$id.',id'
        ]);

        if($validator->fails()) {
            return redirect()->route('roles.edit',$id)->withInput()->withErrors($validator);
        }

        $data = $validator->validated();
        $role = Role::findOrFail($id);

        if(!$role) {
            return redirect()->route('roles.index')->with('error', 'Role not found!');
        }

        $role->update($data);

        if(!empty($request->permission)) {
            // let's assign permissions to a role
            $role->syncPermissions($request->permission);
        }
        else {
            $role->syncPermissions([]);
        }
        return redirect()->route('roles.index')->with('success', 'Role is updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::find($id);

        if (!$role) {
            return response()->json(['status' => 404, 'message' => 'Role not found']);
        }

        $role->delete();
        return response()->json(['status' => 200, 'message' => 'Role deleted successfully']);
    }
}

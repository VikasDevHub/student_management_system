<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BatchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $batches = Batch::orderBy('created_at','ASC')->get();
            return view('backend.batches.list', compact('batches'));

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
            $teachers = Teacher::orderBy('name','ASC')->pluck('name');
            return view('backend.batches.create', compact('teachers'));

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
            'name' => 'required',
            'size_of_batch' => 'required|integer|max:500',
            'batch_admin' => 'required'
        ]);


        if($validator->fails()){
            return redirect()->route('batch.create')->withInput()->withErrors($validator);
        }

        $data = $validator->validated();
        if($data['batch_admin'] == 'select')
        {
            return redirect()->route('batch.create')->withInput()->withErrors(['batch_admin' => 'Please select another option']);
        }

        $batch = Batch::create($data);

        if($batch) {
            return redirect()->route('batch.index')->with('success', 'Batch is created Successfully');
        }

        return redirect()->route('batch.create')->with('error','Something went wrong try again');
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
            $batch = Batch::findOrFail($id);
            $teachers = Teacher::orderBy('name','ASC')->pluck('name');
            return view('backend.batches.edit', compact('batch', 'teachers'));

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
            'name' => 'required',
            'size_of_batch' => 'required|integer|max:500',
            'batch_admin' => 'required'
        ]);


        if($validator->fails()){
            return redirect()->route('batch.edit', $id)->withInput()->withErrors($validator);
        }

        $data = $validator->validated();
        if($data['batch_admin'] == 'select')
        {
            return redirect()->route('batch.edit', $id)->withInput()->withErrors(['batch_admin' => 'Please select another option']);
        }

        $batch = Batch::findOrFail($id);

        if($batch) {
            if(!$batch->update($data)){
                return redirect()->route('batch.index')->with('error','Something went wrong please try again.');
            }
            return redirect()->route('batch.index')->with('success', 'Batch is updated Successfully');
        }

        return redirect()->route('batch.index')->with('error','Batch not found.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       $batch = Batch::find($id);

        if (!$batch) {
            return response()->json(['status' => 404, 'message' => 'Batch not found']);
        }

        $batch->update(['status' => 0]);
        return response()->json(['status' => 200, 'message' => 'Batch deleted successfully']);
    }
}

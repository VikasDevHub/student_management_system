<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Dashboard view
    public function index()
    {
        try {
            return view('backend.dashboard.dashboard');
        }catch (\Exception $e)
        {
            // When view not found
            return redirect()->route('page-not-found');
        }

    }
}

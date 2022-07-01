<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $meals = Meal::where('show_date', '>=', now())
            ->with(['food'])
            ->get()
            ->groupBy('show_date');

        return inertia('Admin/Dashboard', compact('meals'));
    }
}

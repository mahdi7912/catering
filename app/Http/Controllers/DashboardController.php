<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $meals = Meal::whereDate('show_date', '>=', now())
            ->with(['food', 'reserves.user.company'])
            ->whereHas('reserves')
            ->get();

        $meals = $meals->groupBy(['show_date', 'meal', 'food.name']);

        $companyReserves = $meals->pluck('reserves')->flatten()->groupBy('user.company.name');
        // todo: use groupBy('user.company.name')

        return inertia('Admin/Dashboard', compact('meals', 'companyReserves'));
    }
}

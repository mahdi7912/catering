<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Meal;
use Illuminate\Http\Request;
use Verta;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $time = now()->addWeek($request->week ?? 0);

        $startOfWeek = (new Verta($time))->startWeek()->toCarbon();

        $meals = Meal::with(['food.category'])
            ->whereBetween('show_date', [$startOfWeek->format('Y-m-d'), $startOfWeek->addDays(7)->format('Y-m-d')])
            ->get()
            ->groupBy('show_date');

        $foods = $meals->pluck('food')->groupBy('category.name');

        $company = $request->user()->company;

        return inertia('User/Profile/Index', [
            'meals' => $meals,
            'time' => $time,
            'foods' => $foods,
            'company' => $company,
            'startOfWeek' => $startOfWeek,
            'week' => $request->week ?? 0
        ]);
    }
}

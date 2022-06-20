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

        $tmpStartOfWeek = clone $startOfWeek;

        $meals = Meal::with(['food.sundries'])
            ->whereBetween('show_date', [$tmpStartOfWeek->format('Y-m-d'), $tmpStartOfWeek->addDays(7)->format('Y-m-d')])
            ->get()
            ->groupBy(['show_date', 'meal']);

        $company = $request->user()->company;

        return inertia('User/Profile/Index', [
            'meals' => $meals,
            'time' => $time,
            'company' => $company,
            'startOfWeek' => $startOfWeek,
            'week' => $request->week ?? 0
        ]);
    }

    public function reserve(Request $request)
    {
        $meal = Meal::findOrFail($request->meal_id);

        $meal->reserves()->create([
            'food_date_id' => $meal->id,
            'user_id' => auth()->id(),
            'number' => 1,
            'price' => $meal->price,
        ]);

        return ['message' => 'ok'];
    }
}

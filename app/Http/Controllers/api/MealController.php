<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Meal;
use Illuminate\Http\Request;

class MealController extends Controller
{
    public function index()
    {
        return ['Meal' => Meal::paginate(request('allMain') ? 10000 : 15)];
    }

    public function store(Request $request)
    {
        $meal = Meal::create($request->all());

        return ['message' => 'با موفقیت ثبت شد.', 'Meal' => $meal];
    }

    public function update(Request $request, Meal $meal)
    {
        $meal->update($request->all());

        $meal->save();

        return ['message' => 'با موفقیت ویرایش شد.', 'Meal' => $meal];
    }

    public function destroy(Meal $meal)
    {
        $meal->delete();

        return ['message' => 'حذف با موفقیت انجام شد.'];
    }
}

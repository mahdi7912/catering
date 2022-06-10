<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    public function index()
    {
        return ['Food' => Food::paginate(request('allMain') ? 10000 : 15)];
    }

    public function store(Request $request)
    {
        $food = Food::create($request->all());

        return ['message' => 'با موفقیت ثبت شد.', 'Food' => $food];
    }

    public function update(Request $request, Food $food)
    {
        $food->update($request->all());

        $food->save();

        return ['message' => 'با موفقیت ویرایش شد.', 'Food' => $food];
    }

    public function destroy(Food $food)
    {
        $food->delete();

        return ['message' => 'حذف با موفقیت انجام شد.'];
    }
}

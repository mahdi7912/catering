<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Reserve;
use Illuminate\Http\Request;

class ReserveController extends Controller
{
    public function index()
    {
        return ['Reserve' => Reserve::with(['user', 'meal' => fn ($q) => $q->with('food')])->paginate(request('allMain') ? 10000 : 15)];
    }

    public function store(Request $request)
    {
        $reserve = Reserve::create($request->all());

        return ['message' => 'با موفقیت ثبت شد.', 'Reserve' => $reserve];
    }

    public function update(Request $request, Reserve $reserve)
    {
        $reserve->update($request->all());

        $reserve->save();

        return ['message' => 'با موفقیت ویرایش شد.', 'Reserve' => $reserve];
    }

    public function destroy(Reserve $reserve)
    {
        $reserve->delete();

        return ['message' => 'حذف با موفقیت انجام شد.'];
    }
}

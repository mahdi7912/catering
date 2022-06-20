<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Sundry;
use Illuminate\Http\Request;

class SundryController extends Controller
{
    public function index()
    {
        return ['Sundry' => Sundry::with('food')->paginate(request('allMain') ? 10000 : 15)];
    }

    public function store(Request $request)
    {
        $sundry = Sundry::create($request->all());

        return ['message' => 'با موفقیت ثبت شد.', 'Sundry' => $sundry];
    }

    public function update(Request $request, Sundry $sundry)
    {
        $sundry->update($request->all());

        $sundry->save();

        return ['message' => 'با موفقیت ویرایش شد.', 'Sundry' => $sundry];
    }

    public function destroy(Sundry $sundry)
    {
        $sundry->delete();

        return ['message' => 'حذف با موفقیت انجام شد.'];
    }
}

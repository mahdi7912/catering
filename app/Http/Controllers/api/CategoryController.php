<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return ['Category' => Category::paginate(request('allMain') ? 10000 : 15)];
    }

    public function store(Request $request)
    {
        $category = Category::create($request->all());

        return ['message' => 'با موفقیت ثبت شد.', 'Category' => $category];
    }

    public function update(Request $request, Category $category)
    {
        $category->update($request->all());

        $category->save();

        return ['message' => 'با موفقیت ویرایش شد.', 'Category' => $category];
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return ['message' => 'حذف با موفقیت انجام شد.'];
    }
}

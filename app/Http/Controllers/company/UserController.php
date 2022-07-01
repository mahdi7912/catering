<?php

namespace App\Http\Controllers\company;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $companyId = auth()->user()->company_id;

        return [
            'User' => User::where('company_id', $companyId)->with('company')->paginate(request('allMain') ? 10000 : 15)
        ];
    }

    public function store(Request $request)
    {
        $companyId = auth()->user()->company_id;

        $password = bcrypt($request->password);

        $user = User::create(['password' => $password, 'company_id' => $companyId] + $request->all());

        return ['message' => 'با موفقیت ثبت شد.', 'User' => $user];
    }

    public function update(Request $request, User $user)
    {
        $password = $user->password;

        if ($request->password) {
            $password = bcrypt($request->password);
        }

        $user->update(['password' => $password] + $request->all());

        $user->save();

        return ['message' => 'با موفقیت ویرایش شد.', 'User' => $user];
    }

    public function destroy(User $user)
    {
        $user->delete();

        return ['message' => 'حذف با موفقیت انجام شد.'];
    }
}

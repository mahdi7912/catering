<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        return ['Company' => Company::paginate(request('allMain') ? 10000 : 15)];
    }

    public function store(Request $request)
    {
        $company = Company::create($request->all());

        return ['message' => 'با موفقیت ثبت شد.', 'Company' => $company];
    }

    public function update(Request $request, Company $company)
    {
        $company->update($request->all());

        $company->save();

        return ['message' => 'با موفقیت ویرایش شد.', 'Company' => $company];
    }

    public function destroy(Company $company)
    {
        $company->delete();

        return ['message' => 'حذف با موفقیت انجام شد.'];
    }
}

<?php

namespace App\Http\Controllers\company;

use App\Http\Controllers\Controller;
use App\Models\Reserve;
use Illuminate\Http\Request;

class ReserveController extends Controller
{
    public function index()
    {
        return [
            'Reserve' => Reserve::whereHas('user', function ($query) {
                $query->where('company_id', auth()->user()->company_id);
            })
                ->with(['user', 'meal' => fn ($q) => $q->with('food')])->paginate(request('allMain') ? 10000 : 15)
        ];
    }
}

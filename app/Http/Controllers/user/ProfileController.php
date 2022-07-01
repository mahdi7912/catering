<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Meal;
use App\Models\Reserve;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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

        $toDayReserves = Meal::with('food')
            ->whereHas('reserves', fn ($q) => $q->where('user_id', auth()->id()))
            ->whereDate('show_date', now())
            ->get();

        return inertia('User/Profile/Index', [
            'meals' => $meals,
            'time' => $time,
            'company' => $company,
            'toDayReserves' => $toDayReserves,
            'startOfWeek' => $startOfWeek,
            'week' => $request->week ?? 0
        ]);
    }

    public function reserve(Request $request)
    {
        $meal = Meal::findOrFail($request->meal_id);

        $reserve = $request->user()->reserves()->where('food_date_id', $meal->id)->get();

        $user = auth()->user();

        if ($reserve->count() > 0) {
            Reserve::destroy($reserve->pluck('id'));
            $user->update([
                'credit' => $user->credit + $meal->price
            ]);
            return ['message' => 'با موفقیت حذف شد'];
        }

        if ($meal->price > $user->credit) {
            return response(['message' => 'اعتبار شما کافی نیست'], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $user->update([
            'credit' => $user->credit - $meal->price
        ]);

        $meal->reserves()->create([
            'food_date_id' => $meal->id,
            'user_id' => auth()->id(),
            'number' => 1,
            'price' => $meal->price,
        ]);

        return ['message' => 'با موفقیت رزرو شد'];
    }
}

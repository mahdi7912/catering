<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    use HasFactory;

    protected $table = 'food_dates';

    protected $guarded = [
        'id',
    ];

    public function food()
    {
        return $this->belongsTo(Food::class);
    }

    public function reserves()
    {
        return $this->hasMany(Reserve::class, 'food_date_id');
    }

    public function userReserve()
    {
        return $this->reserves()->where('user_id', auth()->id())->first();
    }

    public function getPriceAttribute()
    {
        $company = auth()->user()->company;

        $price = $this->food->price;

        if (!$company) {
            return $price;
        }

        if ($company->increase_percent) {
            $price = $this->food->price * (1 + $company->increase_percent / 100);
        }

        if ($company->increase_rate) {
            $price += $company->increase_rate;
        }

        $price -= $company->subsidy;

        return ceil($price / 100) * 100;
    }

    public function getIsPastAttribute()
    {
        return now()->addDays(1)->gt($this->show_date);
    }


    public function toArray()
    {
        $array = parent::toArray();

        $reserve = $this->userReserve();

        return [
            'reserve' => $reserve,
            'is_reserved' => !!$reserve,
            'is_past' => $this->is_past,
            'price' => $this->price
        ] + $array;
    }
}

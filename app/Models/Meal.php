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

    public function food(){
        return $this->belongsTo(Food::class);
    }
}

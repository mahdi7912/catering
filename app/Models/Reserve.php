<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserve extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function meal(){
        return $this->belongsTo(Meal::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}

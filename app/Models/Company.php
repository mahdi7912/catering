<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public $casts = [
        'business_days' => 'array'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function admins()
    {
        return $this->users()->where('type', 'company');
    }

    public function toArray()
    {
        $parent = parent::toArray();

        return ['admins' => $this->admins()->get()] + $parent;
    }
}

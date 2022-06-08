<?php

namespace App\Models;

use App\Models\Offer;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employement extends Offer
{
    use HasFactory;


    public static function getAll()
    {
        return static::all()->paginate(10);
    }




    public function offer()
    {
        return $this->morphOne(Offer::class,'offerable');
    }

    protected $casts = [
        'trainings' => 'array'
    ];


}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternShip extends Model
{
    use HasFactory;

    protected $table = 'internships';

    public $guarded = [];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function offer()
    {
        return $this->morphOne(Offer::class, 'offerable');
    }

    protected $casts = [
        'trainings' => 'array'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    public $guarded=[];

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

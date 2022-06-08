<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Offer extends Model
{
    use HasFactory;

    public $guarded=[];



    public static function getOfferFieldByCompany(){
        $fields1 = [];
        $fields1 = Auth::user()->offers()->select('fields')->get();
        $fields2 = [];
        foreach ($fields1 as $field) {
            $fields2 = collect($fields2)->push($field->fields);
        }

        return $fields2 = collect($fields2)->collapse()->unique()->all();
    }




    public function offerable()
    {
        return $this->morphTo('offerable');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function bookMarks(){
        return $this->hasMany(BookMark::class);
    }

    public function proposals()
    {
        return $this->hasMany(Proposal::class);
    }


    public function isMarked(): bool
    {
        if (auth()->user()) {
            return auth()->user()->bookMarks()->forOffer($this)->count();
        }

        return false;
    }

    public function removeMark(): bool
    {
        if (auth()->user()) {
            return auth()->user()->bookMarks()->forOffer($this)->delete();
        }

        return false;
    }

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'fields' => 'array',
        'skills' => 'array',
        'education_levels' => 'array',
        'languages' => 'array',
        'qualities' => 'array',
        'trainings' => 'array'
    ];


}

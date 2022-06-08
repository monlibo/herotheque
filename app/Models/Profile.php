<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Profile extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function user(){
       return $this->belongsTo(User::class);
    }

    public function proExperiences(){
        return $this->hasMany(ProExperience::class);
    }

    public function trainings()
    {
        return $this->hasMany(Training::class);
    }


    public function canPostulate()
    {
        $profile = Profile::where('user_id',Auth::user()->id)->first();

        if($profile->short_bio && collect($profile->skills)->isNotEmpty()  && collect($profile->trainings)->isNotEmpty()  && collect($profile->languages)->isNotEmpty() && $profile->education_level ){
            return true;
        }

        return false;
    }


    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'skills' => 'array',
        'languages' => 'array'
    ];


}

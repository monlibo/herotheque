<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationInterview extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $table= "application_interviews";

    public function application()
    {
        return $this->belongsTo(Application::class);
    }
}

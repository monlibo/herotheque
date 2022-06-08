<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookMark extends Model
{
    use HasFactory;
    protected $table="bookmarks";
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }

    public function scopeForOffer($query, Offer $offer)
    {
        return $query->where('offer_id', $offer->id);
    }

}


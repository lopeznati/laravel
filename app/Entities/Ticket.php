<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    //
    protected $fillable=['titulo', 'status'];

    public function comments(){
        return $this->hasMany(TicketComment::class);

    }
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function voters(){
        return $this->belongsToMany(User::class,'ticket_votes')->withTimestamps();
    }
}

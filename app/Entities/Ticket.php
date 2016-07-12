<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    //
    protected $fillable=['titulo', 'status','link'];

    public function comments(){
        return $this->hasMany(TicketComment::class);

    }
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function voters(){
        return $this->belongsToMany(User::class,'ticket_votes')->withTimestamps();
    }

    public function assignResource($comment)
    {
        if (is_numeric($comment)) {
            $comment = TicketComment::findOrFail($comment);
        }

        if ($comment->link == '' || $this->id != $comment->ticket_id) {
            abort(404);
        }

        $this->link = $comment->link;
        $this->status = 'closed';
        $this->save();

        $this->comments()->where('selected', true)->update(['selected' => false]);

        $comment->selected = true;
        $comment->save();
    }
}

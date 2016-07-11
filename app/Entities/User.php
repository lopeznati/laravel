<?php

namespace App\Entities;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function tickets(){
        return $this->hasMany(Ticket::class);
    }
    /*

    public function comments(){
        return $this->hasMany(TicketComment::class);
    }*/

    public function voted(){
        return $this->belongsToMany(Ticket::class,'ticket_votes')->withTimestamps();
    }

    public function hasVote(Ticket $ticket){
        return $this->voted()->where('ticket_id',$ticket->id)->count();

       // return TicketVote::where(['user-id'=>$this->id,'ticket_id'=>$ticket->id])->count();
    }
    
    
    /*

    public function vote(Ticket $ticket){
       if($this->hasvote($ticket)) {
           return false;
       }

        $this->voted()->attach($ticket);
        return true;

       }

    public function unvote(Ticket $ticket){

        $this->voted()->detach($ticket);
        return true;

    }*/





}

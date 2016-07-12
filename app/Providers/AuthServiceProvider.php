<?php

namespace App\Providers;

use App\Entities\Ticket;
use App\Policies\TicketPolicy;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        //'App\Model' => 'App\Policies\ModelPolicy',
        Ticket::class>TicketPolicy::class
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        //le da acceso al add a todo el sistema
       $gate->before(function ($user){

           if($user->role==='admin'){
               return true;
           }

       });


        $this->registerPolicies($gate);

        //
        //le da acceso al add a todo el sistema

    }
}

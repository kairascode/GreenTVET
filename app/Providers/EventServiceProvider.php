<?php

namespace App\Providers;

use App\Events\ChallengeReported;
use Illuminate\Support\ServiceProvider;
use App\Events\TreePlanted;
use App\Listeners\SendTreePlantingNotification;

class EventServiceProvider extends ServiceProvider
{

    protected $listen = [
            TreePlanted::class => [
                SendTreePlantingNotification::class,
        ],
       // ChallengeReported::class=>[],
    ];
    
    
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        
    

    }
}

<?php

namespace App\Listeners;
use App\Events\TreePlanted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\TreePlantedNotification;


class SendTreePlantingNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(TreePlanted $event): void
    {
         Mail::to($event->treePlanting->institution->contact_email)->send(
            new TreePlantedNotification($event->treePlanting)
        );
    }
    
}

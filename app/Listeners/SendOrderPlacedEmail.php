<?php

namespace App\Listeners;

use App\Events\OrderPlaced;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderPlaced as OrderPlacedMail;


class SendOrderPlacedEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\OrderPlaced  $event
     * @return void
     */
   
     public function handle(OrderPlaced $event)
     {
        
         $user = $event->order->user; // Assuming there's a relationship between Order and User
         $order = $event->order;
     
         // Send the email using the Mailable instance
         Mail::to($user->email)->send(new OrderPlaced($order));
     }
}

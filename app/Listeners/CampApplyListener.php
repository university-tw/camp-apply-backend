<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\CampApplyNotice;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CampApplyListener {
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct() {
        //
    }

    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle($event) {
        $event->applicant->notify(new CampApplyNotice($event->apply));
        User::whereEmail('ryanchang1117@gmail.com')->first()->notify(new CampApplyNotice($event->apply));
    }
}

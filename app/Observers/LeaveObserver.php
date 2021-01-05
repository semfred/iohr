<?php

namespace App\Observers;

use App\Leave;

class LeaveObserver
{
    /**
     * Handle the leave "created" event.
     *
     * @param  \App\Leave  $leave
     * @return void
     */
    public function created(Leave $leave)
    {
        //
    }

    /**
     * Handle the leave "updated" event.
     *
     * @param  \App\Leave  $leave
     * @return void
     */
    public function updated(Leave $leave)
    {
        //
    }

    /**
     * Handle the leave "deleted" event.
     *
     * @param  \App\Leave  $leave
     * @return void
     */
    public function deleted(Leave $leave)
    {
        //
    }

    /**
     * Handle the leave "restored" event.
     *
     * @param  \App\Leave  $leave
     * @return void
     */
    public function restored(Leave $leave)
    {
        //
    }

    /**
     * Handle the leave "force deleted" event.
     *
     * @param  \App\Leave  $leave
     * @return void
     */
    public function forceDeleted(Leave $leave)
    {
        //
    }
}

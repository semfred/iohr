<?php

namespace App\Observers;

use App\Employment;

class EmploymentObserver
{
    /**
     * Handle the employment "created" event.
     *
     * @param  \App\Employment  $employment
     * @return void
     */
    public function created(Employment $employment)
    {
        //
    }

    /**
     * Handle the employment "updated" event.
     *
     * @param  \App\Employment  $employment
     * @return void
     */
    public function updated(Employment $employment)
    {
        //
    }

    /**
     * Handle the employment "deleted" event.
     *
     * @param  \App\Employment  $employment
     * @return void
     */
    public function deleted(Employment $employment)
    {
        //
    }

    /**
     * Handle the employment "restored" event.
     *
     * @param  \App\Employment  $employment
     * @return void
     */
    public function restored(Employment $employment)
    {
        //
    }

    /**
     * Handle the employment "force deleted" event.
     *
     * @param  \App\Employment  $employment
     * @return void
     */
    public function forceDeleted(Employment $employment)
    {
        //
    }
}

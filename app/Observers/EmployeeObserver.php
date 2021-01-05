<?php

namespace App\Observers;

use App\Employee;
use App\User;
use App\Employment;
use App\Entitlement;

class EmployeeObserver
{
    /**
     * Handle the employee "created" event.
     *
     * @param  \App\Employee  $employee
     * @return void
     */
    public function created(Employee $employee)
    {
        $user = User::firstOrNew(['email'     => $employee->email]);
        $user->name = $employee->fname.' '.$employee->lname;
        $user->password = bcrypt('123456');
        $user->save();

        $employment = Employment::updateOrCreate(['employee_id' => $employee->id]);

        $ent = Entitlement::create([
            'employee_id'       => $employee->id,
            'vacation'          => 5,
            'sick'              => 5,
            'year'              => \Carbon\Carbon::now()->year
        ]);


        $employee->entitlement()->save($ent);
        $employee->employment()->save($employment);
        $employee->user()->save($user);
        // $user->sendEmailVerificationNotification();

    }

    /**
     * Handle the employee "updated" event.
     *
     * @param  \App\Employee  $employee
     * @return void
     */
    public function updated(Employee $employee)
    {
        //
    }

    /**
     * Handle the employee "deleted" event.
     *
     * @param  \App\Employee  $employee
     * @return void
     */
    public function deleted(Employee $employee)
    {
        $employee->user()->delete();
    }

    /**
     * Handle the employee "restored" event.
     *
     * @param  \App\Employee  $employee
     * @return void
     */
    public function restored(Employee $employee)
    {
        $employee->user()->restore();
    }

    /**
     * Handle the employee "force deleted" event.
     *
     * @param  \App\Employee  $employee
     * @return void
     */
    public function forceDeleted(Employee $employee)
    {
        $employee->user()->forceDelete();
    }
}

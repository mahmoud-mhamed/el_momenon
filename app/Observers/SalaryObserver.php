<?php

namespace App\Observers;

use App\Models\Salary;
use Carbon\Carbon;

class SalaryObserver
{
    /**
     * Handle the Salary "created" event.
     */
    public function creating(Salary $salary): void
    {
        $this->setSalaryDate($salary);
    }

    public function setSalaryDate(Salary $salary): void
    {
        $salary->salary_date=Carbon::create($salary->year,$salary->month->value,1)->format('Y-m-d');
    }

    /**
     * Handle the Salary "updated" event.
     */
    public function updating(Salary $salary): void
    {
        $this->setSalaryDate($salary);
    }

    /**
     * Handle the Salary "deleted" event.
     */
    public function deleted(Salary $salary): void
    {
        //
    }

    /**
     * Handle the Salary "restored" event.
     */
    public function restored(Salary $salary): void
    {
        //
    }

    /**
     * Handle the Salary "force deleted" event.
     */
    public function forceDeleted(Salary $salary): void
    {
        //
    }
}

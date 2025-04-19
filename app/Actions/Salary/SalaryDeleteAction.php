<?php

namespace App\Actions\Salary;

use App\Classes\Abilities;
use App\Classes\BaseAction;
use App\Models\Salary;

class SalaryDeleteAction extends BaseAction
{
    protected Abilities $ability=Abilities::M_SALARY_DELETE;

    public function handle(Salary $salary)
    {
        $this->tryDelete($salary);
        return back();
    }
}

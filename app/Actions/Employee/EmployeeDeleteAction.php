<?php

namespace App\Actions\Employee;

use App\Classes\Abilities;
use App\Classes\BaseAction;
use App\Models\Employee;

class EmployeeDeleteAction extends BaseAction
{
    protected Abilities $ability=Abilities::M_EMPLOYEE_DELETE;

    public function handle(Employee $employee)
    {
        $this->tryDelete($employee);
        return back();
    }
}

<?php

namespace App\Actions\Employee;

use App\Classes\Abilities;
use App\Classes\BaseAction;
use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;

class EmployeeUpdateAction extends BaseAction
{
    protected Abilities $ability=Abilities::M_EMPLOYEE_EDIT;

    public function handle(Employee $employee,EmployeeRequest $request)
    {
        $employee->update($request->validated());
        $this->makeSuccessSessionMessage();
        return back();
    }
}

<?php

namespace App\Actions\Employee;

use App\Classes\Abilities;
use App\Classes\BaseAction;
use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;

class EmployeeStoreAction extends BaseAction
{
    protected Abilities $ability=Abilities::M_EMPLOYEE_CREATE;

    public function handle(EmployeeRequest $request)
    {
        Employee::create($request->validated());
        $this->makeSuccessSessionMessage();
        return back();
    }
}

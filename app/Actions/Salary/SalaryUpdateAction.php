<?php

namespace App\Actions\Salary;

use App\Classes\Abilities;
use App\Classes\BaseAction;
use App\Http\Requests\SalaryRequest;
use App\Models\Salary;

class SalaryUpdateAction extends BaseAction
{
    protected Abilities $ability=Abilities::M_SALARY_EDIT;

    public function handle(Salary $salary,SalaryRequest $request)
    {
        $salary->update($request->validated());
        $this->makeSuccessSessionMessage();
        return back();
    }
}

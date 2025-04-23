<?php

namespace App\Actions\Employee;

use App\Actions\Salary\SalaryIndexAction;
use App\Classes\Abilities;
use App\Classes\BaseAction;
use App\Models\Employee;
use App\Models\Salary;
use Inertia\Inertia;

class EmployeeSalaryIndexAction extends BaseAction
{
    protected Abilities $ability=Abilities::M_EMPLOYEE_SALARY_INDEX;

    public function handle(Employee $employee)
    {
        EmployeeIndexAction::make()->useBreadcrumb([
            ['label'=>$employee->name],
        ]);
        $data = SalaryIndexAction::make()->getFormCreateUpdateData();
        $data['rows']=SalaryIndexAction::make()->getQuery()->where('employee_id',$employee->id)->paginate();
        $filters=Salary::query()->getFilters();
        unset($filters['employee_id']);
        $this->useFilter($filters);
        $data['employee']=$employee;

        return Inertia::render('Salary/EmployeeIndex', compact('data'));
    }
}

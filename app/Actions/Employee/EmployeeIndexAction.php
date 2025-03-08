<?php

namespace App\Actions\Employee;

use App\Classes\Abilities;
use App\Classes\BaseAction;
use App\Enums\ModuleNameEnum;
use App\Models\Client;
use App\Models\Employee;
use Inertia\Inertia;

class EmployeeIndexAction extends BaseAction
{
    protected Abilities $ability=Abilities::M_EMPLOYEE_INDEX;

    public function handle()
    {
        $this->useBreadcrumb();
        $query = Employee::query()
            ->latest('id')
            ->search(['name', 'phone']);
        $this->allowSearch();
        $data = $this->getFormCreateUpdateData();
        $data['rows'] = $query->paginate();
        $this->useFilter(Employee::query()->getFilters());

        return Inertia::render('Employee/Index', compact('data'));
    }

    public function getFormCreateUpdateData(): array
    {
        return [
            'form_data' => [
            ]
        ];
    }

    public function useBreadcrumb($append_breadcrumb = []): void
    {
        $this->breadcrumb([
            ['label' => ModuleNameEnum::getTrans(ModuleNameEnum::EMPLOYEE), 'url' => route('dashboard.employee.index'), 'ability' => $this->ability],
            ...$append_breadcrumb
        ]);
    }
}

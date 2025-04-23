<?php

namespace App\Actions\Salary;

use App\Classes\Abilities;
use App\Classes\BaseAction;
use App\Enums\ModuleNameEnum;
use App\Enums\SalaryMonthEnum;
use App\Enums\SalaryTypeEnum;
use App\Models\Employee;
use App\Models\Salary;
use Inertia\Inertia;

class SalaryIndexAction extends BaseAction
{
    protected Abilities $ability=Abilities::M_SALARY_INDEX;

    public function handle()
    {
        $this->useBreadcrumb();
        $query = $this->getQuery();
        $this->allowSearch();
        $data = $this->getFormCreateUpdateData();
        $data['rows'] = $query->paginate();
        $this->useFilter(Salary::query()->getFilters());

        return Inertia::render('Salary/Index', compact('data'));
    }

    public function getQuery()
    {
        return Salary::query()
            ->with('employee')
            ->latest('id')
            ->filter()
            ->search(['amount','note']);
    }

    public function getFormCreateUpdateData(): array
    {
        return [
            'form_data' => [
                'employees' => Employee::query()->get(['id', 'name', 'salary']),
                'types' => SalaryTypeEnum::getOptionsData(),
                'months' => SalaryMonthEnum::getOptionsData(),
                'current_month' => now()->month,
                'current_year' => now()->year,
            ]
        ];
    }

    public function useBreadcrumb($append_breadcrumb = []): void
    {
        $this->breadcrumb([
            ['label' => ModuleNameEnum::getTrans(ModuleNameEnum::SALARY), 'url' => route('dashboard.salary.index'), 'ability' => $this->ability],
            ...$append_breadcrumb
        ]);
    }
}

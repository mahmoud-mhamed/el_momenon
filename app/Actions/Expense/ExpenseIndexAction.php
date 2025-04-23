<?php

namespace App\Actions\Expense;

use App\Classes\Abilities;
use App\Classes\BaseAction;
use App\Enums\ModuleNameEnum;
use App\Enums\SalaryMonthEnum;
use App\Enums\SalaryTypeEnum;
use App\Models\Employee;
use App\Models\Expense;
use App\Models\Salary;
use Inertia\Inertia;

class ExpenseIndexAction extends BaseAction
{
    protected Abilities $ability=Abilities::M_EXPENSE_INDEX;

    public function handle()
    {
        $this->useBreadcrumb();
        $query = Expense::query()
            ->latest('id')
            ->filter()
            ->search(['note']);
        $this->allowSearch();
        $data = $this->getFormCreateUpdateData();
        $data['rows'] = $query->paginate();
        $this->useFilter(Expense::query()->getFilters());

        return Inertia::render('Expense/Index', compact('data'));
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
            ['label' => ModuleNameEnum::getTrans(ModuleNameEnum::EXPENSE), 'url' => route('dashboard.expense.index'), 'ability' => $this->ability],
            ...$append_breadcrumb
        ]);
    }
}

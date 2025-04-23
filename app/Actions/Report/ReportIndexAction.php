<?php

namespace App\Actions\Report;

use App\Classes\Abilities;
use App\Classes\BaseAction;
use App\Classes\Helpmate;
use App\Enums\ModuleNameEnum;
use App\Models\Expense;
use App\Models\Salary;
use App\Models\Supplier;
use Inertia\Inertia;
use Lorisleiva\Actions\ActionRequest;
use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Exp;

class ReportIndexAction extends BaseAction
{
    protected Abilities $ability = Abilities::M_REPORT_INDEX;

    public function handle(ActionRequest $request)
    {
        $period = Helpmate::getRangeFromRequestPeriod($request->date_range);

        $this->useBreadcrumb();
        $data['period'] = $period;
        $data['date_range'] = $request->date_range;

        $data['expenses'] = $this->makeStatisticCard(
            ModuleNameEnum::getTrans(ModuleNameEnum::EXPENSE),
            $this->appendCurrency(Expense::query()->rangeDateFilter($period, 'created_at')->sum('amount')),
            'pi-users',
            route('dashboard.expense.index'),
        );
        $data['salaries'] = $this->makeStatisticCard(
            ModuleNameEnum::getTrans(ModuleNameEnum::SALARY),
            $this->appendCurrency(Salary::query()->rangeDateFilter($period, 'salary_date')->sum('amount')),
            'pi-users',
            route('dashboard.salary.index'),
        );
        return Inertia::render('Report/Index', compact('data'));
    }

    public function useBreadcrumb($append_breadcrumb = []): void
    {
        $this->breadcrumb([
            ['label' => ModuleNameEnum::getTrans(ModuleNameEnum::REPORT), 'url' => route('dashboard.report.index'), 'ability' => $this->ability],
            ...$append_breadcrumb
        ]);
    }
}

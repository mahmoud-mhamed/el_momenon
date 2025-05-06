<?php

namespace App\Actions\Notebook;

use App\Classes\Abilities;
use App\Classes\BaseAction;
use App\Enums\ModuleNameEnum;
use App\Enums\NotebookTypeEnum;
use App\Models\Bill;
use App\Models\Currency;
use App\Models\Notebook;
use Inertia\Inertia;

class NotebookIndexAction extends BaseAction
{
    protected Abilities $ability = Abilities::M_NOTEBOOK_INDEX;

    public function handle(): \Inertia\Response
    {
        $this->useBreadcrumb();
        $this->allowSearch();
        $query = Notebook::query()
            ->with('currency')
            ->latest('date')
            ->search(['statement', 'sender', 'recipient']);
        $data = $this->getFormCreateUpdateData();
        $data['rows'] = $query->paginate();

        $this->useFilter(Notebook::query()->getFilters());

        return Inertia::render('Notebook/Index', compact('data'));
    }

    public function getFormCreateUpdateData(): array
    {
        return [
            'form_data' => [
                'currencies' => Currency::all(),
                'types' => NotebookTypeEnum::getOptionsData(),
            ],
        ];
    }

    public function useBreadcrumb($append_breadcrumb = []): void
    {
        $this->breadcrumb([
            ['label' => ModuleNameEnum::getTrans(ModuleNameEnum::NOTEBOOK), 'url' => route('dashboard.notebook.index'), 'ability' => $this->ability],
            ...$append_breadcrumb
        ]);
    }
}

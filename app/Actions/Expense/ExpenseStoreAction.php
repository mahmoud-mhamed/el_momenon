<?php

namespace App\Actions\Expense;

use App\Classes\Abilities;
use App\Classes\BaseAction;
use App\Http\Requests\ExpenseRequest;
use App\Models\Expense;

class ExpenseStoreAction extends BaseAction
{
    protected Abilities $ability=Abilities::M_EXPENSE_CREATE;

    public function handle(ExpenseRequest $request)
    {
        Expense::create($request->validated());
        $this->makeSuccessSessionMessage();
        return back();
    }
}

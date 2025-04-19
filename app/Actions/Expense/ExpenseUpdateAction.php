<?php

namespace App\Actions\Expense;

use App\Classes\Abilities;
use App\Classes\BaseAction;
use App\Http\Requests\ExpenseRequest;
use App\Models\Expense;

class ExpenseUpdateAction extends BaseAction
{
    protected Abilities $ability=Abilities::M_EXPENSE_EDIT;

    public function handle(Expense $expense,ExpenseRequest $request)
    {
        $expense->update($request->validated());
        $this->makeSuccessSessionMessage();
        return back();
    }
}

<?php

namespace App\Actions\Expense;

use App\Classes\Abilities;
use App\Classes\BaseAction;
use App\Models\Expense;

class ExpenseDeleteAction extends BaseAction
{
    protected Abilities $ability=Abilities::M_EXPENSE_DELETE;

    public function handle(Expense $expense)
    {
        $this->tryDelete($expense);
        return back();
    }
}

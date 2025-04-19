<?php

namespace App\Actions\Salary;

use App\Classes\Abilities;
use App\Classes\BaseAction;
use App\Http\Requests\SalaryRequest;
use App\Models\Salary;

class SalaryStoreAction extends BaseAction
{
    protected Abilities $ability = Abilities::M_SUPPLIER_STORE;

    public function handle(SalaryRequest $request)
    {
        $validated_data = $request->validated();
        if (!data_get($validated_data,'year'))
            $validated_data['year'] = now()->year;
        Salary::create($validated_data);
        $this->makeSuccessSessionMessage();
        return back();
    }
}

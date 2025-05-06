<?php

namespace App\Actions\Notebook;

use App\Classes\Abilities;
use App\Classes\BaseAction;
use App\Http\Requests\NotebookRequest;
use App\Models\Notebook;

class NotebookStoreAction extends BaseAction
{
    protected Abilities $ability=Abilities::M_NOTEBOOK_STORE;

    public function handle(NotebookRequest $request)
    {
        Notebook::create($request->validated());
        $this->makeSuccessSessionMessage();
        return back();
    }
}

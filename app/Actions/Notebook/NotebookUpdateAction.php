<?php

namespace App\Actions\Notebook;

use App\Classes\Abilities;
use App\Classes\BaseAction;
use App\Http\Requests\NotebookRequest;
use App\Models\Notebook;

class NotebookUpdateAction extends BaseAction
{
    protected Abilities $ability=Abilities::M_NOTEBOOK_UPDATE;

    public function handle(Notebook $notebook,NotebookRequest $request)
    {
        $notebook->update($request->validated());
        $this->makeSuccessSessionMessage();
        return back();
    }
}

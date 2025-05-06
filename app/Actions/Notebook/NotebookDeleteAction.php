<?php

namespace App\Actions\Notebook;

use App\Classes\Abilities;
use App\Classes\BaseAction;
use App\Models\Notebook;

class NotebookDeleteAction extends BaseAction
{
    protected Abilities $ability=Abilities::M_NOTEBOOK_DELETE;

    public function handle(Notebook $notebook)
    {
        $this->tryDelete($notebook);
        return back();
    }
}

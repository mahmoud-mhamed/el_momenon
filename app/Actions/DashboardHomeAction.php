<?php

namespace App\Actions;

use App\Classes\BaseAction;
use Inertia\Inertia;

class DashboardHomeAction extends BaseAction
{
    public function handle()
    {
        $this->pageTitle(__('message.home'));
        $this->useTransparent();
        $data = [];
        return Inertia::render('Home', compact('data'));
    }
}

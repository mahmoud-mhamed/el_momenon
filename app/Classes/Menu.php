<?php

namespace App\Classes;

use App\Enums\ModuleNameEnum;
use App\Services\BouncerService;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class Menu
{
    public function getMenu(): array
    {
        $current_route_name = Route::currentRouteName();
        $response[] = ['label' => __('message.home'), 'icon' => 'pi-home',
            'href' => \route('dashboard.home'),
            'active' => Str::startsWith($current_route_name, 'dashboard.home')
        ];

        if (BouncerService::checkAbility(Abilities::M_USERS_INDEX))
            $response[] = ['label' => ModuleNameEnum::getTrans(ModuleNameEnum::USERS->value), 'icon' => 'pi-users',
                'href' => \route('dashboard.users.index'),
                'active' => Str::startsWith($current_route_name, 'dashboard.users.') || Str::startsWith($current_route_name, 'dashboard.roles.')
            ];


        if (BouncerService::checkAbility(Abilities::M_CURRENCIES_INDEX))
            $response[] = ['label' => ModuleNameEnum::getTrans(ModuleNameEnum::CURRENCIES->value), 'icon' => 'pi-dollar',
                'href' => \route('dashboard.currency.index'),
                'active' => Str::startsWith($current_route_name, 'dashboard.currency.')
            ];

        if (BouncerService::checkAbility(Abilities::M_CLIENT_INDEX))
            $response[] = ['label' => ModuleNameEnum::getTrans(ModuleNameEnum::CLIENT->value), 'icon' => 'pi-users',
                'href' => \route('dashboard.client.index'),
                'active' => Str::startsWith($current_route_name, 'dashboard.client.')
            ];

        if (BouncerService::checkAbility(Abilities::M_SUPPLIER_INDEX))
            $response[] = ['label' => ModuleNameEnum::getTrans(ModuleNameEnum::SUPPLIER->value), 'icon' => 'pi-users',
                'href' => \route('dashboard.supplier.index'),
                'active' => Str::startsWith($current_route_name, 'dashboard.supplier.')
            ];

        if (BouncerService::checkAbility(Abilities::M_BILL_INDEX))
            $response[] = ['label' => ModuleNameEnum::getTrans(ModuleNameEnum::BILL->value), 'icon' => 'pi-receipt',
                'href' => \route('dashboard.bill.index'),
                'active' => Str::startsWith($current_route_name, 'dashboard.bill.')
            ];

        if (BouncerService::checkAbility(Abilities::M_EMPLOYEE_INDEX))
            $response[] = ['label' => ModuleNameEnum::getTrans(ModuleNameEnum::EMPLOYEE->value), 'icon' => 'pi-users',
                'href' => \route('dashboard.employee.index'),
                'active' => Str::startsWith($current_route_name, 'dashboard.employee.')
            ];

        if (BouncerService::checkAbility(Abilities::M_SALARY_INDEX))
            $response[] = ['label' => ModuleNameEnum::getTrans(ModuleNameEnum::SALARY->value), 'icon' => 'pi-receipt',
                'href' => \route('dashboard.salary.index'),
                'active' => Str::startsWith($current_route_name, 'dashboard.salary.')
            ];

        if (BouncerService::checkAbility(Abilities::M_EXPENSE_INDEX))
            $response[] = ['label' => ModuleNameEnum::getTrans(ModuleNameEnum::EXPENSE->value), 'icon' => 'pi-receipt',
                'href' => \route('dashboard.expense.index'),
                'active' => Str::startsWith($current_route_name, 'dashboard.expense.')
            ];

        if (BouncerService::checkAbility(Abilities::M_NOTEBOOK_INDEX))
            $response[] = ['label' => ModuleNameEnum::getTrans(ModuleNameEnum::NOTEBOOK->value), 'icon' => 'pi-receipt',
                'href' => \route('dashboard.notebook.index'),
                'active' => Str::startsWith($current_route_name, 'dashboard.notebook.')
            ];

        if (BouncerService::checkAbility(Abilities::M_REPORT_INDEX))
            $response[] = ['label' => ModuleNameEnum::getTrans(ModuleNameEnum::REPORT->value), 'icon' => 'pi-chart-line',
                'href' => \route('dashboard.report.index'),
                'active' => Str::startsWith($current_route_name, 'dashboard.report.')
            ];
        return $response;
    }



}

<?php

namespace App\Enums;

use App\Traits\EnumOptionsTrait;

enum ModuleNameEnum: string
{
    use EnumOptionsTrait;
    case USERS='users';
    case ROLES='roles';
    case CURRENCIES='currencies';
    case SUPPLIER='supplier';
    case CLIENT='client';

    case BILL='bill';
    case BILL_PAYMENT='bill_payment';
    case EMPLOYEE='employee';
    case SALARY='salary';
    case EXPENSE='expense';
    case REPORT='report';
    case NOTEBOOK='notebook';

}

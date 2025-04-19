<?php

namespace App\Enums;

use App\Traits\EnumOptionsTrait;

enum SalaryTypeEnum: string
{
    use EnumOptionsTrait;

    case ADDITION='addition';
    case SALARY='salary';
}

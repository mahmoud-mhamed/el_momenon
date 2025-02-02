<?php

namespace App\Enums;

use App\Traits\EnumOptionsTrait;

enum IsActiveEnum: int
{
    use EnumOptionsTrait;

    case ACTIVE = 1;
    case NOT_ACTIVE = 0;
}

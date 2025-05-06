<?php

namespace App\Enums;

use App\Traits\EnumOptionsTrait;

enum NotebookTypeEnum: string
{
    use EnumOptionsTrait;

    case SENDER='sender';
    case RECEIVER='receiver';
}

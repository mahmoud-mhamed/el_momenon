<?php

namespace App\Enums;

use App\Traits\EnumOptionsTrait;

enum ArchiveCollectionNameEnum: string
{
    use EnumOptionsTrait;

    case DISABLED_CLIENT_FRONT_NATIONAL_ID = 'disabled_client_front_national_id';
    case DISABLED_CLIENT_BACK_NATIONAL_ID = 'disabled_client_back_national_id';
    case DISABLED_CLIENT_ENVELOPE = 'disabled_client_envelope';
    case NATIONAL_ID_IMG_FRONT = 'national_id_img_front';
    case NATIONAL_ID_IMG_BACK = 'national_id_img_back';
}

<?php

use App\Enums\ArchiveCollectionNameEnum;
use App\Enums\BillPurchaseTypeEnum;

return [
    'ModuleNameEnum' => [
        \App\Enums\ModuleNameEnum::USERS->value => 'المستخدمين',
        \App\Enums\ModuleNameEnum::ROLES->value => 'الأدوار',
        \App\Enums\ModuleNameEnum::CURRENCIES->value => 'العملات',
        \App\Enums\ModuleNameEnum::SUPPLIER->value => 'الموردين',
        \App\Enums\ModuleNameEnum::CLIENT->value => 'العملاء',
        \App\Enums\ModuleNameEnum::BILL->value => 'الفواتير',
    ],
    \App\Enums\BillStatusEnum::getFileName()=>[
        \App\Enums\BillStatusEnum::PENDING->value => 'قيد الإنتظار',
        \App\Enums\BillStatusEnum::PURCHASED->value => 'تم الشراء',
        \App\Enums\BillStatusEnum::SHIPPED->value => 'تم الشحن',
        \App\Enums\BillStatusEnum::IN_CUSTOMS->value => 'في الجمرك',
        \App\Enums\BillStatusEnum::DELIVERED->value => 'تم التسليم',
    ],
    \App\Enums\BillPurchaseTypeEnum::getFileName()=>[
        BillPurchaseTypeEnum::INITIATIVE->value => 'مبادرة',
        BillPurchaseTypeEnum::DISABILITY_ANSWER->value => 'جواب إعاقة',
        BillPurchaseTypeEnum::PERSONAL->value => 'شخصي',
    ],
    \App\Enums\ArchiveCollectionNameEnum::getFileName()=>[
        ArchiveCollectionNameEnum::DISABLED_CLIENT_FRONT_NATIONAL_ID->value => 'صورة البطاقة الشخصية الأمامية',
        ArchiveCollectionNameEnum::DISABLED_CLIENT_BACK_NATIONAL_ID->value => 'صورة البطاقة الشخصية الخلفية',
        ArchiveCollectionNameEnum::DISABLED_CLIENT_ENVELOPE->value => 'الجواب',
    ],
];

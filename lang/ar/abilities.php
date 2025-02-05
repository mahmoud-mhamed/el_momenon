<?php

$index = 'عرض';
$create = 'إضافة';
$update = 'تعديل';
$delete = 'حذف';
$viewProfile = 'البيانات الأساسية';
$toggleActive = 'حالة التفعيل';
$toggleDefault = 'حالة الافتراض';
$import = 'استيراد اكسل';
$export = 'التصدير اكسل';
$viewUsers = 'مشاهدة المستخدمين';
$sort = 'الترتيب';
$notify = 'تنبيه';
$report = 'تقرير';
$show = 'عرض البيانات';
$sendNotification = 'إرسال إشعار';
$add_custom_ability = 'إضافة صلاحيات مخصصه';

use App\Classes\Abilities;

return [
    Abilities::M_USERS_INDEX->value => $index,
    Abilities::M_USERS_INDEX_EXPORT->value => $export,
    Abilities::M_USERS_MAIN_DATA->value => $viewProfile,
    Abilities::M_USERS_DELETE->value => $delete,
    Abilities::M_USERS_UPDATE->value => $update,
    Abilities::M_USERS_STORE->value => $create,
    Abilities::M_USERS_ADD_CUSTOM_ABILITY->value => $add_custom_ability,

    Abilities::M_ROLES_INDEX->value => $index,
    Abilities::M_ROLES_STORE->value => $create,
    Abilities::M_ROLES_EDIT->value => $update,
    Abilities::M_ROLES_DELETE->value => $delete,
    Abilities::M_ROLES_INDEX_EXPORT->value => $export,


    Abilities::M_CURRENCIES_INDEX->value => $index,
    Abilities::M_CURRENCIES_STORE->value => $create,
    Abilities::M_CURRENCIES_EDIT->value => $update,
    Abilities::M_CURRENCIES_DELETE->value => $delete,
];

<?php

namespace App\Classes;

use App\Enums\ModuleNameEnum;
use App\Traits\EnumOptionsTrait;

enum Abilities: string
{
    use EnumOptionsTrait;
    case M_USERS_INDEX = 'm_users_index';
    case M_USERS_INDEX_EXPORT = 'm_users_index_export';
    case M_USERS_STORE = 'm_users_store';
    case M_USERS_UPDATE = 'm_users_update';
    case M_USERS_DELETE = 'm_users_delete';
    case M_USERS_MAIN_DATA = 'm_users_main_data';
    case M_USERS_ADD_CUSTOM_ABILITY = 'm_users_add_custom_ability';
    // Roles
    case M_ROLES_INDEX = 'm_roles_index';
    case M_ROLES_STORE = 'm_roles_store';
    case M_ROLES_EDIT = 'm_roles_edit';
    case M_ROLES_DELETE = 'm_roles_delete';
    case M_ROLES_INDEX_EXPORT = 'm_roles_index_export';

    // currencies
    case M_CURRENCIES_INDEX = 'm_currencies_index';
    case M_CURRENCIES_STORE = 'm_currencies_store';
    case M_CURRENCIES_EDIT = 'm_currencies_edit';
    case M_CURRENCIES_DELETE = 'm_currencies_delete';

    // suppliers
    case M_SUPPLIER_INDEX = 'm_supplier_index';
    case M_SUPPLIER_STORE = 'm_supplier_store';
    case M_SUPPLIER_EDIT = 'm_supplier_edit';
    case M_SUPPLIER_DELETE = 'm_supplier_delete';

    public const PERMISSIONS = [
        ['key' => self::M_USERS_INDEX, 'module' => ModuleNameEnum::USERS],
        ['key' => self::M_USERS_INDEX_EXPORT, 'module' => ModuleNameEnum::USERS],
        ['key' => self::M_USERS_STORE, 'module' => ModuleNameEnum::USERS],
        ['key' => self::M_USERS_UPDATE, 'module' => ModuleNameEnum::USERS],
        ['key' => self::M_USERS_MAIN_DATA, 'module' => ModuleNameEnum::USERS],
        ['key' => self::M_USERS_DELETE, 'module' => ModuleNameEnum::USERS],
        ['key' => self::M_USERS_ADD_CUSTOM_ABILITY, 'module' => ModuleNameEnum::USERS],

        ['key' => self::M_ROLES_INDEX, 'module' => ModuleNameEnum::ROLES],
        ['key' => self::M_ROLES_INDEX_EXPORT, 'module' => ModuleNameEnum::ROLES],
        ['key' => self::M_ROLES_EDIT, 'module' => ModuleNameEnum::ROLES],
        ['key' => self::M_ROLES_STORE, 'module' => ModuleNameEnum::ROLES],
        ['key' => self::M_ROLES_DELETE, 'module' => ModuleNameEnum::ROLES],

        ['key' => self::M_CURRENCIES_INDEX, 'module' => ModuleNameEnum::CURRENCIES],
        ['key' => self::M_CURRENCIES_EDIT, 'module' => ModuleNameEnum::CURRENCIES],
        ['key' => self::M_CURRENCIES_STORE, 'module' => ModuleNameEnum::CURRENCIES],
        ['key' => self::M_CURRENCIES_DELETE, 'module' => ModuleNameEnum::CURRENCIES],


        ['key' => self::M_SUPPLIER_INDEX, 'module' => ModuleNameEnum::SUPPLIER],
        ['key' => self::M_SUPPLIER_EDIT, 'module' => ModuleNameEnum::SUPPLIER],
        ['key' => self::M_SUPPLIER_STORE, 'module' => ModuleNameEnum::SUPPLIER],
        ['key' => self::M_SUPPLIER_DELETE, 'module' => ModuleNameEnum::SUPPLIER],

    ];

    public static function getModulePermission(ModuleNameEnum $moduleNameEnum): \Illuminate\Support\Collection
    {
        return collect(self::PERMISSIONS)->where('module', $moduleNameEnum);
    }

    /*get abilities by name*/
    public static function getAbilities(): \Illuminate\Support\Collection
    {
        $items = collect(self::PERMISSIONS);
        $response = collect();
        foreach ($items as $item) {
            $response->push([
                'module' => $item['module'],
                'alias' => $item['alias'] ?? $item['module'],
                'key' => $item['key']->value
            ]);
        }
        return $response;
    }

    /*get abilities by name*/
    public static function getAbilitiesGroupByModule(): \Illuminate\Support\Collection
    {
        return self::getAbilities()->groupBy('module');
    }

}

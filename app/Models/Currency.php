<?php

namespace App\Models;

use App\Models\BaseModel;

/**
 * @property string name
 * @property string code
 * @property double equal_value
 * @property boolean is_default
 */
class Currency extends BaseModel
{
    protected $fillable = [
        'name', 'code', 'equal_value', 'is_default',
        'created_by_id', 'created_by_type', 'updated_by_id', 'updated_by_type', 'deleted_by_id', 'deleted_by_type'
    ];

    protected $casts = [
        'is_default' => 'boolean',
    ];
}

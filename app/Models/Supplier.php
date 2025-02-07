<?php

namespace App\Models;

use App\Models\BaseModel;

/**
 * @property string name
 * @property string phone
 * @property string country
 * @property int currency_id
 * @property float account_balance
*/
class Supplier extends BaseModel
{
    protected $fillable = [
        'name', 'phone', 'country', 'currency_id', 'account_balance',
        'created_by_id', 'created_by_type', 'updated_by_id', 'updated_by_type', 'deleted_by_id', 'deleted_by_type'
    ];

    protected $casts = [

    ];
}

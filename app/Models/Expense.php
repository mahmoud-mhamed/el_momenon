<?php

namespace App\Models;


use App\Models\Builders\ExpenseBuilder;
use App\Models\BaseModel;

/**
 * @property string title
 * @property string amount
 * @property string operation_date
 * @property string note
 */
class Expense extends BaseModel
{
    protected $fillable = [
        'title', 'amount', 'operation_date', 'note',
        'created_by_id', 'created_by_type', 'updated_by_id', 'updated_by_type', 'deleted_by_id', 'deleted_by_type'
    ];

    protected $casts = [

    ];


    /**
     * @return ExpenseBuilder
     */
    public static function query(): ExpenseBuilder
    {
        return parent::query();
    }

    /**
     * @param $query
     * @return ExpenseBuilder
     */
    public function newEloquentBuilder($query): ExpenseBuilder
    {
        return new ExpenseBuilder($query);
    }
}

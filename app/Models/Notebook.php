<?php

namespace App\Models;


use App\Models\Builders\NotebookBuilder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Enums\NotebookTypeEnum;
use App\Traits\EnumCastAppendAttributeTrait;use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string date
 * @property string type
 * @property int currency_id
 * @property double currency_amount
 * @property double eg_currency_amount
 * @property string statement
 * @property string sender
 * @property string recipient
 * @property-read string $type_text
 * @property-read Currency $currency
 */
class Notebook extends BaseModel
{
    protected $fillable = [
        'date', 'type', 'currency_id', 'currency_amount', 'eg_currency_amount', 'statement', 'sender', 'recipient',
        'created_by_id', 'created_by_type', 'updated_by_id', 'updated_by_type', 'deleted_by_id', 'deleted_by_type'
    ];

    protected $casts = [
        'type' => NotebookTypeEnum::class,
        'date' => 'date:Y-m-d'

    ];

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }
    /**
     * @return NotebookBuilder
     */
    public static function query(): NotebookBuilder
    {
        return parent::query();
    }

    /**
     * @param $query
     * @return NotebookBuilder
     */
    public function newEloquentBuilder($query): NotebookBuilder
    {
        return new NotebookBuilder($query);
    }
}

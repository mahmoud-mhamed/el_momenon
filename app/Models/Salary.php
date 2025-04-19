<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Enums\SalaryMonthEnum;
use App\Traits\EnumCastAppendAttributeTrait;
use App\Enums\SalaryTypeEnum;
use App\Models\Builders\SalaryBuilder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string employee_id
 * @property string amount
 * @property string type
 * @property string month
 * @property string year
 * @property string note
 * @property-read Employee $employee
 * @property-read string $type_text
 * @property-read string month_year
  * @property-read string $month_text
 */
class Salary extends BaseModel
{
    protected $fillable = [
        'employee_id', 'amount', 'type', 'month', 'year', 'note',
        'created_by_id', 'created_by_type', 'updated_by_id', 'updated_by_type', 'deleted_by_id', 'deleted_by_type'
    ];

    protected $appends = [
        'month_year'
    ];

    protected $casts = [
        'month' => SalaryMonthEnum::class,
        'type' => SalaryTypeEnum::class,
    ];

    public function getMonthYearAttribute(): string
    {
        return $this->month?->value.' / '.$this->year;
    }
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    /**
     * @return SalaryBuilder
     */
    public static function query(): SalaryBuilder
    {
        return parent::query();
    }

    /**
     * @param $query
     * @return SalaryBuilder
     */
    public function newEloquentBuilder($query): SalaryBuilder
    {
        return new SalaryBuilder($query);
    }
}

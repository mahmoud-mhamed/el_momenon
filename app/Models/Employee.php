<?php

namespace App\Models;


use App\Models\Builders\EmployeeBuilder;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string name
 * @property string phone
 * @property string salary
 * @property-read Salary[] salaries
*/
class Employee extends BaseModel
{
    protected $fillable = [
        'name', 'phone', 'salary',
        'created_by_id', 'created_by_type', 'updated_by_id', 'updated_by_type', 'deleted_by_id', 'deleted_by_type'
    ];

    protected $casts = [

    ];

    public function salaries(): HasMany
    {
        return $this->hasMany(Salary::class, 'employee_id');
    }
    /**
     * @return EmployeeBuilder
     */
    public static function query(): EmployeeBuilder
    {
        return parent::query();
    }

    /**
     * @param $query
     * @return EmployeeBuilder
     */
    public function newEloquentBuilder($query): EmployeeBuilder
    {
        return new EmployeeBuilder($query);
    }
}

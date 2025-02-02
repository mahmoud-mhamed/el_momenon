<?php

namespace App\Traits;

use App\Models\Department;
use App\Models\Scopes\DepartmentScope;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

/**
 * @property int department_id;
 * @property-read Department department;
 */
trait BelongsToDepartmentTrait
{
    final static function bootBelongsToDepartmentTrait(): void
    {
        if (auth()->check() && Auth::user()->department_id) {
            static::addGlobalScope(new DepartmentScope());
            static::creating(static function ($model) {
                $model->department_id = auth()->user()?->department_id;
            });
        }
    }

    final public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
}

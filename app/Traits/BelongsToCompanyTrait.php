<?php

namespace App\Traits;

use App\Models\Company;
use App\Models\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

/**
 * @property int company_id;
 * @property-read Company company;
 */
trait BelongsToCompanyTrait
{
    final static function bootBelongsToCompanyTrait(): void
    {
        if (auth()->check() && Auth::user()->company_id) {
            static::addGlobalScope(new CompanyScope());
            static::creating(static function ($model) {
                if (!$model->company_id)
                    $model->company_id = auth()->user()?->company_id;
            });
        }
    }

    final public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}

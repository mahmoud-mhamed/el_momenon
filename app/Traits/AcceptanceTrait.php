<?php

namespace App\Traits;

use App\Models\AcceptanceSeries;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * @property-read AcceptanceSeries[] acceptances
*/
trait AcceptanceTrait
{
    public function acceptance(): MorphMany
    {
        return $this->morphMany(AcceptanceSeries::class,'model')->orderBy('id','asc');
    }
    public function acceptances(): MorphMany
    {
        return $this->morphMany(AcceptanceSeries::class,'model')->orderBy('id','asc');
    }
}

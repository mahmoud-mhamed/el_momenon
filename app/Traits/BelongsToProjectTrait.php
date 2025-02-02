<?php

namespace App\Traits;

use App\Models\Project;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int project_id;
 * @property-read Project $project;
 */
trait BelongsToProjectTrait
{
    final public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}

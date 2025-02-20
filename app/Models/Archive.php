<?php

namespace App\Models;

use App\Enums\ArchiveCollectionNameEnum;
use App\Traits\BelongsToBillTrait;
use App\Traits\BelongsToClientTrait;
use App\Traits\FileUploadTrait;

/**
 * @property string name
 * @property string collection_name
 * @property int bill_id
 * @property int client_id
 * @property int disabled_client_id
 * @property string file
 * @property-read string $collection_name_text
 * @property-read Client $disabledClient
 */
class Archive extends BaseModel
{
    use BelongsToClientTrait, BelongsToBillTrait;
    use FileUploadTrait;

    protected $fillable = [
        'name', 'collection_name', 'bill_id', 'client_id', 'disabled_client_id', 'file',
        'created_by_id', 'created_by_type', 'updated_by_id', 'updated_by_type', 'deleted_by_id', 'deleted_by_type'
    ];

    protected $casts = [
        'collection_name' => ArchiveCollectionNameEnum::class,

    ];

    protected array $fileupload = [
        'file'
    ];

    public function disabledClient(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Client::class, 'disabled_client_id');
    }

}

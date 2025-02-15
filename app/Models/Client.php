<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Traits\FileUploadTrait;

/**
 * @property string name
 * @property string phone
 * @property string national_id_img_front
 * @property string national_id_img_back
 * @property string national_id
 * @property string note
 */
class Client extends BaseModel
{
    use FileUploadTrait;

    protected $fillable = [
        'name', 'phone', 'national_id_img_front', 'national_id_img_back', 'national_id','note',
        'created_by_id', 'created_by_type', 'updated_by_id', 'updated_by_type', 'deleted_by_id', 'deleted_by_type'
    ];

    protected $casts = [

    ];

    protected array $fileupload = [
        'national_id_img_front', 'national_id_img_back'
    ];
}

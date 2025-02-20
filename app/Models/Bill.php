<?php

namespace App\Models;

use App\Enums\BillPurchaseTypeEnum;
use App\Enums\BillStatusEnum;
use App\Observers\BillObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int supplier_id
 * @property int client_id
 * @property int disabled_client_id
 * @property int currency_id
 * @property string purchase_type
 * @property string purchase_price
 * @property string selling_price
 * @property string currency_equal_value
 * @property string purchase_date
 * @property string chassis_number
 * @property string car_type
 * @property string shipping_date
 * @property string shipping_amount
 * @property string shipping_type
 * @property string policy_number
 * @property string notes
 * @property-read string $status_text
 * @property-read Client $client
 * @property-read Client disabledClient
 * @property-read Supplier supplier
 * @property-read Archive[] $archives
 */
#[ObservedBy([BillObserver::class])]
class Bill extends BaseModel
{
    protected $fillable = [
        'supplier_id', 'client_id', 'disabled_client_id', 'currency_id', 'purchase_price', 'purchase_type', 'selling_price', 'currency_equal_value',
        'purchase_date', 'chassis_number', 'car_type', 'shipping_date', 'shipping_type', 'shipping_amount',
        'policy_number', 'notes', 'status',
        'created_by_id', 'created_by_type', 'updated_by_id', 'updated_by_type', 'deleted_by_id', 'deleted_by_type'
    ];

    protected $casts = [
        'purchase_type' => BillPurchaseTypeEnum::class,
        'status' => BillStatusEnum::class,


    ];


    public function archives(): HasMany
    {
        return $this->hasMany(Archive::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function disabledClient(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'disabled_client_id');
    }
}

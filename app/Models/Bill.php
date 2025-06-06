<?php

namespace App\Models;


use App\Classes\Helpmate;
use App\Models\Builders\BillBuilder;
use App\Enums\BillPurchaseTypeEnum;
use App\Enums\BillStatusEnum;
use App\Observers\BillObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int supplier_id
 * @property int client_id
 * @property string disabled_name
 * @property string disabled_national_id
 * @property int currency_id
 * @property string purchase_type
 * @property string purchase_price
 * @property string selling_price
 * @property string purchase_date
 * @property string chassis_number
 * @property string car_type
 * @property string shipping_date
 * @property string shipping_amount
 * @property string shipping_type
 * @property string policy_number
 * @property string notes
 * @property double supplier_paid_amount
 * @property double client_paid_amount
 * @property-read string $status_text
 * @property-read Client $client
 * @property-read Client disabledClient
 * @property-read Supplier supplier
 * @property-read Currency $currency
 * @property-read Archive[] $archives
 * @property-read double supplier_rent_amount
 * @property-read double client_rent_amount
 * @property-read string name
 * @property string disability_amount
 */
#[ObservedBy([BillObserver::class])]
class Bill extends BaseModel
{
    protected $fillable = [
        'supplier_id', 'supplier_paid_amount', 'client_paid_amount', 'client_id',
        'disabled_name', 'disabled_national_id','disability_amount',
        'currency_id', 'purchase_price',
        'purchase_type',
        'selling_price',
        'purchase_date', 'chassis_number', 'car_type', 'shipping_date', 'shipping_type', 'shipping_amount',
        'policy_number', 'notes', 'status',
        'created_by_id', 'created_by_type', 'updated_by_id', 'updated_by_type', 'deleted_by_id', 'deleted_by_type'
    ];

    protected $casts = [
        'purchase_type' => BillPurchaseTypeEnum::class,
        'status' => BillStatusEnum::class,
    ];
    protected $appends = [
        'name',
        'client_rent_amount', 'supplier_rent_amount',
        'profit',
    ];


    public function getNameAttribute(): string
    {
        return '#' . $this->id . ' - ' . $this->chassis_number . ' - ' . $this->car_type;
    }

    public function getProfitAttribute(): float|int|null
    {
        $car_price = ($this->selling_price ?? 0) - ($this->purchase_price ?? 0)
            - ($this->shipping_amount ?? 0)
            - ($this->disability_amount ?? 0);
        return $car_price > 0 ? Helpmate::toFixed($car_price) : null;
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }


    public function getSupplierRentAmountAttribute(): float|int|null
    {
        return Helpmate::toFixed($this->purchase_price - $this->supplier_paid_amount);
    }

    public function getClientRentAmountAttribute(): float|int|null
    {
        return Helpmate::toFixed($this->selling_price - $this->client_paid_amount);
    }

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

    /**
     * @return BillBuilder
     */
    public static function query(): BillBuilder
    {
        return parent::query();
    }

    /**
     * @param $query
     * @return BillBuilder
     */
    public function newEloquentBuilder($query): BillBuilder
    {
        return new BillBuilder($query);
    }
}

<?php

namespace App\Models;


use App\Models\Builders\SupplierBuilder;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string name
 * @property string phone
 * @property string country
 * @property int currency_id
 * @property string current_account
 * @property string sum_paid
 * @property string sum_bills_amount
 * @property-read Currency currency
 * @property-read Bill[] $bills
 */
class Supplier extends BaseModel
{
    protected $fillable = [
        'name', 'phone', 'country', 'currency_id', 'current_account','sum_bills_amount','sum_paid',
        'created_by_id', 'created_by_type', 'updated_by_id', 'updated_by_type', 'deleted_by_id', 'deleted_by_type'
    ];

    protected $casts = [

    ];

    public function bills(): HasMany
    {
        return $this->hasMany(Bill::class);
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    /**
     * @return SupplierBuilder
     */
    public static function query(): SupplierBuilder
    {
        return parent::query();
    }

    /**
     * @param $query
     * @return SupplierBuilder
     */
    public function newEloquentBuilder($query): SupplierBuilder
    {
        return new SupplierBuilder($query);
    }
}

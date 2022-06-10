<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'purchase_orders';
    protected $guarded = ['id'];

    const STATUS_OPEN = 'Open';
    const STATUS_CLOSE = 'Close';
    const STATUS_HOLD = 'Hold';
    const STATUS_CANCEL = 'Cancel';

    const STATUS_LIST = [
        self::STATUS_OPEN => self::STATUS_OPEN,
        self::STATUS_HOLD => self::STATUS_HOLD,
        self::STATUS_CLOSE => self::STATUS_CLOSE,
        self::STATUS_CANCEL => self::STATUS_CANCEL,
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function purchase_order_item()
    {
        return $this->hasMany(PurchaseOrderItem::class, 'purchase_order_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductServiceSerial extends Model
{
    protected $fillable = ['product_service_id', 'serial_number'];
    
    public function service()
    {
        return $this->belongsTo(ProductService::class);
    }
}

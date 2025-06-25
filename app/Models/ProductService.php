<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductService extends Model
{
    protected $table = 'product_services'; // jika nama tabel custom

    // Daftar kolom yang boleh di-mass-assignment
    protected $fillable = [
        'serial_number',
        'type_product',
        'problem',
        'name_customer',
        'email_customer',
        'handphone_customer',
        'receipt',
        'category',
        'date',
        'type_service',
        'status',
        'actual_problem',
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    // Jika kamu menggunakan timestamps (created_at/updated_at), pastikan properti berikut:
    public $timestamps = true;
}

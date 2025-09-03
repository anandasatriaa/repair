<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SparePartPrice extends Model
{
    use HasFactory;

    // Nama tabel custom jika berbeda dari 'spare_part_prices'
    protected $table = 'spare_parts_price';

    protected $fillable = [
        'spare_part_id',
        'price',
        'effective_date',
    ];

    // Relasi: Setiap harga dimiliki oleh satu SparePart
    public function sparePart(): BelongsTo
    {
        return $this->belongsTo(SparePart::class);
    }
}

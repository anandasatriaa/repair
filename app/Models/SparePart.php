<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SparePart extends Model
{
    use SoftDeletes;
    
    use HasFactory;

    protected $fillable = [
        'item_code',
        'description',
        'quantity',
        'unit',
        'moq',
        'brand',
    ];

    // Relasi: Satu SparePart memiliki banyak riwayat harga
    public function prices(): HasMany
    {
        return $this->hasMany(SparePartPrice::class);
    }

    // Helper Relasi: Untuk mendapatkan harga terbaru yang berlaku
    public function currentPrice(): HasOne
    {
        return $this->hasOne(SparePartPrice::class)
            ->ofMany('effective_date', 'max');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KatalogPaket extends Model
{
    protected $table = 'Katalog_Paket';
    protected $primaryKey = 'Paket_id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'Nama_paket',
        'Harga',
        'Dekripsi_pkt',
        'Kategori',
        'Admin_id',
    ];

    protected $casts = [
        'Harga' => 'decimal:0',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'Admin_id', 'id');
    }

    public function pesanan(): HasMany
    {
        return $this->hasMany(Pesanan::class, 'Paket_id', 'Paket_id');
    }
}
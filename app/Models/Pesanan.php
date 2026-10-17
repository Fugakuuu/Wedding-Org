<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pesanan extends Model
{
    protected $table = 'Pesanan';
    protected $primaryKey = 'Pesanan_id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'Paket_id',
        'Nama_pemesan',
        'Email_pemesan',
        'No_WA',
        'Tanggal_acara',
        'Catatan',
        'Status',
        'User_id',
    ];

    protected $casts = [
        'Tanggal_acara' => 'date',
    ];

    public function paket(): BelongsTo
    {
        return $this->belongsTo(KatalogPaket::class, 'Paket_id', 'Paket_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'User_id', 'id');
    }
}
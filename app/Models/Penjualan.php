<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualan';
    protected $fillable = [
        'pelanggan_id',
        'barang_keluar_id',
        'nota',
        'tanggal',
        'setoran',
        'piutang'
    ];

    /**
     * Get the user that owns the Penjualan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
}

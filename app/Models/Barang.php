<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';
    protected $fillable = [
        'nama_barang',
        'harga_beli',
        'harga_jual',
        'jumlah',
        'satuan',
        'status'
    ];
}

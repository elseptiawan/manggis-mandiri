<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Piutang extends Model
{
    use HasFactory;

    protected $table = 'piutang';
    protected $fillable = [
        'pelanggan_id',
        'hutang',
        'setoran'
    ];
}

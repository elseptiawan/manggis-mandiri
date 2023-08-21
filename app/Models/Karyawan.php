<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $table = 'karyawan';
    protected $fillable = [
        'user_id',
        'nama_karyawan',
        'no_hp',
        'posisi'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

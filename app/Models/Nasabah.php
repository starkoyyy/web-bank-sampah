<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nasabah extends Model
{
    // 1. Beritahu Laravel nama tabel yang benar (tanpa 's')
    protected $table = 'nasabah';

    // 2. Matikan timestamps agar tidak error mencari created_at / updated_at
    public $timestamps = false;

    // 3. Kolom yang diizinkan untuk diisi
    protected $fillable = ['user_id', 'alamat', 'total_saldo', 'jenis_kelamin'];
}
<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiTarik extends Model
{
    protected $table = 'transaksi_tarik';
    public $timestamps = false;
    protected $fillable = ['nasabah_id', 'jumlah_tarik', 'tanggal_tarik'];
}
<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiSetor extends Model
{
    protected $table = 'transaksi_setor';
    public $timestamps = false;
    protected $fillable = ['nasabah_id', 'kategori_id', 'berat', 'total_harga', 'tanggal_setor'];
}
<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    public $timestamps = false; // Karena tabel Anda tidak punya created_at
    protected $fillable = ['nama', 'username', 'password', 'role'];
    protected $hidden = ['password'];
}
<?php

namespace App\Models;

// Import Authenticatable agar bisa digunakan untuk Login
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Account extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'accounts';

    // Karena primary key kamu bukan 'id', wajib didefinisikan
    protected $primaryKey = 'id_account';

    // Kolom yang boleh diisi secara massal
    protected $fillable = [
        'nama_account',
        'jenis',
        'email',
        'password',
        'saldo'
    ];

    // Kolom yang harus disembunyikan (tidak muncul saat return JSON)
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Relasi ke Tabel Transaksi
     * Satu akun bisa punya banyak transaksi (Quest Log)
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'id_account', 'id_account');
    }
}

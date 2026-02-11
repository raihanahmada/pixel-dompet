<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;
    protected $table = 'transactions';
    protected $primaryKey = 'id_transaction';

    protected $fillable = [
        'id_account',
        'nama_transaksi',
        'tipe',
        'jumlah',
        'keterangan',
        'tanggal'
    ];

    // Relasi: transaksi milik satu akun
    public function account()
    {
        return $this->belongsTo(Account::class, 'id_account', 'id_account');
    }
}

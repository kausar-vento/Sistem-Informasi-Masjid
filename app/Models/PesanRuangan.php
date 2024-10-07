<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PesanRuangan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // public function ruangan() {
    //     return $this->belongsTo('App\Ruangan', 'id_ruangan');
    // }

    public function transaksi() {
        return $this->hasMany(Transaksi::class);
    }

    public function neraca() {
        return $this->hasMany(Neraca::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}

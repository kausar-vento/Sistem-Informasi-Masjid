<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Neraca extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function pesanruangan(): BelongsTo
    {
        return $this->belongsTo(PesanRuangan::class, 'id_pesan_ruangan');
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'id_admin');
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'id_boking_event');
    }

    public function fundraising(): BelongsTo
    {
        return $this->belongsTo(FundRaising::class, 'id_fund_raising');
    }
}

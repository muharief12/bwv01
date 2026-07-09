<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisPeserta extends Model
{
    use HasFactory;

    protected $table = 'jenis_pesertas';
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function aktivitas_pesertas()
    {
        return $this->hasMany(AktivitasPeserta::class, 'jenis_peserta_id');
    }
}

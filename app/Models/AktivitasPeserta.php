<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AktivitasPeserta extends Model
{
    use HasFactory;

    protected $table = 'aktivitas_pesertas';
    protected $guarded = ['id'];

    public function jenis_peserta()
    {
        return $this->belongsTo(JenisPeserta::class, 'jenis_peserta_id', 'id');
    }

    public function materi_pelatihan()
    {
        return $this->belongsTo(MateriPelatihan::class, 'materi_pelatihan_id', 'id');
    }

    public function instruktur()
    {
        return $this->belongsTo(User::class, 'instruktur_id', 'id');
    }
}

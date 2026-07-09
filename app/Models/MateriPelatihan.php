<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MateriPelatihan extends Model
{
    use HasFactory;

    protected $table = 'materi_pelatihans';
    protected $guarded = ['id'];

    public function aktivitas_pesertas()
    {
        return $this->hasMany(AktivitasPeserta::class, 'materi_pelatihan_id');
    }
}

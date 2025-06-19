<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuti extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cuti';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pegawai_id',
        'tanggal_mulai_cuti',
        'tanggal_selesai_cuti',
        'durasi_cuti',
        'tipe_cuti',
        'alasan_cuti',
        'status_pengajuan',
    ];

    /**
     * Get the pegawai that owns the cuti.
     */
    public function _pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjamans';

    protected $fillable = [
        'kode',
        'kategori',
        'nama',
        'keperluan',
        'lampiran',
        'kegiatan',
        'tanggal_awal',
        'tanggal_akhir',
        'jam_awal',
        'jam_akhir',
        'keterangan',
        'jumlah',
        'kendaraan_id',
        'is_sopir',
        'sopir_id',
        'telp',
    ];

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class);
    }
    
    public function sopir()
    {
        return $this->belongsTo(Sopir::class);
    }
}

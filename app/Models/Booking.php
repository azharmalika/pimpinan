<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'ruangan_id', 'nama_peminjam', 'tanggal', 'waktu_mulai', 'waktu_selesai', 'keperluan'
    ];

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class);
    }
}

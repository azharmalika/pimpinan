<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $fillable = [
        'user_id', 'judul', 'tanggal_mulai',
        'prioritas', 'kategori', 'tempat', 'deskripsi', 'file',
        'kehadiran_file', 'is_delegated',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}

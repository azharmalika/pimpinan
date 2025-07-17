<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TranskripPresensi extends Model
{
    protected $fillable = ['agenda_id', 'pimpinan', 'hadir'];

    public function agenda() {
        return $this->belongsTo(Agenda::class);
    }
}

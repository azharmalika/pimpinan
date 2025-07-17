<?php

namespace App\Exports;

use App\Models\Agenda;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class AgendaExport implements FromView
{
    public function view(): View
    {
        $data = array(
            'agenda'       => Agenda::with('user')->get(),
            'tanggal'      => now()->format('d-m-Y'),
            'jam'          => now()->format('H.i.s'),
        );
        return view('admin/agenda/excel',$data);
    }
}

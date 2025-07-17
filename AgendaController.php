<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public function index(){
        $data = array(
            'title'          => 'Data Agenda',
            'menuAdminAgenda'  => 'active',
        );
        return view('admin/agenda/index',$data);
    }
}

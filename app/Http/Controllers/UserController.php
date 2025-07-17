<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Exports\UserExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function index(){
        $data = array(
            'title'          => 'Data User',
            'menuAdminUser'  => 'active',
            'user'           => User::orderBy ('jabatan', 'asc')->get(),
        );
        return view('admin/user/index',$data);
    }

     public function create(){
        $data = array(
            'title'          => 'Tambah Data User',
            'menuAdminUser'  => 'active',
            
        );
        return view('admin/user/create',$data);
    }

    public function store(Request $request){
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|unique:users,username',
            'jabatan' => 'required',
            'password' => 'required|confirmed|min:8',
        ], [
            'nama.required' => 'Nama Tidak Boleh Kosong',
            'email.required' => 'Email Tidak Boleh Kosong',
            'email.unique' => 'Email Sudah Ada',
            'username.required' => 'Username Tidak Boleh Kosong',
            'username.unique' => 'Username Sudah Ada',
            'jabatan.required' => 'Jabatan Harus Di Pilih',
            'password.required' => 'Password Tidak Boleh Kosong',
            'password.confirmed' => 'Konfirmasi Password Tidak Sama',
            'password.min' => 'Password Minimal 8 Karakter',
        ]);
    
        $user = new User;
        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->jabatan = $request->jabatan;
        $user->password = Hash::make($request->password);
        $user->is_tugas = false;
        $user->save();
    
        return redirect()->route('user')->with('success', 'Data Berhasil Ditambahkan');
    }

    public function edit($id){
        $data = array(
            'title'          => 'Edit Data User',
            'menuAdminUser'  => 'active',
            'user'           => user::findOrFail($id),
        );
        return view('admin/user/edit',$data);
    }

    public function update(Request $request, $id){
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'username' => 'required|unique:users,username,'.$id,
            'jabatan' => 'required',
            'password' => 'nullable|confirmed|min:8',
        ], [
            'nama.required' => 'Nama Tidak Boleh Kosong',
            'email.required' => 'Email Tidak Boleh Kosong',
            'email.unique' => 'Email Sudah Ada',
            'username.required' => 'Username Tidak Boleh Kosong',
            'username.unique' => 'Username Sudah Ada',
            'jabatan.required' => 'Jabatan Harus Di Pilih',
            'password.required' => 'Password Tidak Boleh Kosong',
            'password.confirmed' => 'Konfirmasi Password Tidak Sama',
            'password.min' => 'Password Minimal 8 Karakter',
        ]);
    
        $user = User::findOrFail($id);
        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->jabatan = $request->jabatan;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
    
        return redirect()->route('user')->with('success', 'Data Berhasil DiUpdate');
    }

    public function destroy($id){
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user')->with('success','Data Berhasil DiHapus');


    }
    public function excel(){
        $filename = now()->format('d-m-y H.i.s');
        return Excel::download(new UserExport, 'DataUser_'.$filename.'.xlsx');
    }

    public function pdf(){
        $filename = now()->format('d-m-y H.i.s');
        $data = array(
            'user'   => User::get(),
            'tanggal'    => now()->format('d-m-Y'),
            'jam'        => now()->format('H.i.s'),
        );
        $pdf = Pdf::loadView('admin/user/pdf', $data);
        return $pdf->stream('DataUser_'.$filename.'.pdf');
    }
}


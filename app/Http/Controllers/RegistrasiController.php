<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;

class RegistrasiController extends Controller
{
    public function index() {
        return view( 'registrasi.index', [
             'title' => 'Registrasi',
             'active' => 'Registrasi'
        ]);
    }

    public function store(Request $request){
        $ValidatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => ['required', 'min:3', 'max:255', 'unique:users', 'email:dns'],
            'password' => ['required', 'min:5', 'max:255']
        ]);

        User::create($ValidatedData);
        

        return redirect('loginIndex')->with('status', 'Registrasi berhasil');
    }
}

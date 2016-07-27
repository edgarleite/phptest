<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Form login
     *
     * @return Response
     */
    public function getLogin() {
        return view('auth/login');
    }

    /**
     * Efetua login
     *
     * @return Response
     */
    public function postLogin(Request $request)
    {
        if (Auth::attempt(['usuario' => $request->input('usuario'), 'password' => $request->input('senha')], false)) {
            return redirect('/nova-consulta');
        } else {
            return redirect('/login');
        }
    }

    /**
     * Efetua logout
     *
     * @return Response
     */
    public function getLogout() {
        Auth::logout();
        return redirect('/login');
    }
}
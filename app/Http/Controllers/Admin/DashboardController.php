<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 19.03.2017
 * Time: 16:44
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller {

    public function index() {
        $role = \Auth::user()->role;
        if($role == 'admin') {
            return view('adminlte::home');
        } else {
            return redirect()->route('home');
        }
    }

    public function postAuth($request) {
        if(Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')], $request->input('remember') ? true : false)) {
            return redirect()->intended('admin');
        } else {
            return redirect()->back()->with('message', 'Не правильно имя и/или пароль');
        }
    }

    public function coins() {

        $res = json_decode(file_get_contents('https://api.coinmarketcap.com/v1/ticker/?limit=500'), true);
        return view('admin.real-coins', [
            'coins' => $res
        ]);
    }

    public function coin($id) {
        $coin = json_decode(file_get_contents('https://api.coinmarketcap.com/v1/ticker/'.$id), true);
        return view('site.coin', [
            'coin' => $coin
        ]);
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Session;



class SessionCookieController extends Controller
{
    public function getSessionData (Request $request) {

        echo 'GET SESSION ||  ';

        if ($request -> session() -> has('name')) { 

            echo $request -> session() -> get('name');

        } else {
            echo ' NO SESSION ';
        }

        $user = Auth::user();

        echo '  ||  username : '.$user;

        return dd(Session::all());


    }


    public function storeSessionData (Request $request) {

        echo 'SET SESSION';

        $request -> session() -> put('name', "민수");

    }

    public function deleteSessionData (Request $request) {


        $request -> session() -> forget('name');

        echo 'DELETE SESSION';

    }

}

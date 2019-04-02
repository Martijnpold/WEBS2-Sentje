<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class LangController extends Controller
{
    public function switch() {
        $cur = Session::get('lang', 'en');
        switch($cur) {
            case 'en':
                Session::put('lang', 'nl');
                break;
            case 'nl':
                Session::put('lang', 'en');
                break;
        }

        return redirect()->back();
    }
}

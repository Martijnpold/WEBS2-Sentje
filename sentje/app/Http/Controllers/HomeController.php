<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\PaymentRequest;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $requests = PaymentRequest::where('owner_id', $user_id)->get();
        echo '<table style="width:100%">';
        foreach($requests as $request) {
            echo '<tr>';
            echo '<td>' . $request->id . '</td>';
            echo '<td>' . $request->owner_id . '</td>';
            echo '<td>' . $request->amount . '</td>';
            echo '<td>' . $request->created_at . '</td>';
            echo '</tr>';
        }
        echo '</table>';
        return view('home');
    }
}

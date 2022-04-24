<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    public function dashboard(){
        switch (Auth::user()->roles){
            case true:
                return redirect(route('admin.dashboard'));
                break;
            default:
                return redirect(route('operator.dashboard'));
                break;
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 'admin') {
            return redirect()->route('admin-dashboard');
        } else {
            return redirect()->route('dashboard');
        }
    }
}

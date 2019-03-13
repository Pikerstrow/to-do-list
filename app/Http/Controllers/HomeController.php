<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        return view('admin');
    }


    public function getUsername()
    {
        $username = Auth::user()->name;

        return response()->json([
            'username' => $username
        ], 200);
    }
}

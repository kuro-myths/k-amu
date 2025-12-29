<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('kamu'); // Memanggil resources/views/kamu.blade.php
    }
}

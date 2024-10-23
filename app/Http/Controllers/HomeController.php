<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Jika ada data atau pengaturan yang perlu dikirim, bisa dilakukan di sini
        return view('home');
    }
}

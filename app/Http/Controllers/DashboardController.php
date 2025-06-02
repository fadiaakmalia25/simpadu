<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    
    public function index()
    {
        $data = ['nama' => "Fadia", 'foto' => 'Fadia.jpg'];
        return view('dashboard', compact('data'));
    }
}

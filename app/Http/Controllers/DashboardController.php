<?php

namespace App\Http\Controllers;

use App\Models\Acolhido;

class DashboardController extends Controller
{
    public function index()
    {
        $activeUsersCount = Acolhido::where('status', 'ativo')->count();
        return view('home', compact('activeUsersCount'));
    }
}

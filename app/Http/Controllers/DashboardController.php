<?php

namespace App\Http\Controllers;

use App\Models\Morador;

class DashboardController extends Controller
{
    public function index()
    {
        $activeUsersCount = Morador::where('status', 'ativo')->count();
        return view('home', compact('activeUsersCount'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\UserRole;
use Illuminate\Http\Request;

class UserroleController extends Controller
{
    public function index()
    {
        $userRoles = UserRole::all();
        return view('userroles.index', compact('userRoles'));
    }
}

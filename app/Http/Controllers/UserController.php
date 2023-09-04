<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUser() {
        $users = User::all();
        return view('page.user-management', compact('users'));
    }
    
    public function getUserJson() {
        $users = User::all();
        return response()->json($users);
    }
}

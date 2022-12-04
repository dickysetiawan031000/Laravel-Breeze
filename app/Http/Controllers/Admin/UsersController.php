<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        $student = User::where('role_id', 1)->count();
        $teacher = User::where('role_id', 2)->count();
        return view('admin.users', compact('student', 'teacher'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function admin_page()
    {
        return view('admin.admin');
    }

    public function login_store(Request $request)
    {
        $user = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if (Auth::attempt($user)) {
            $request->session()->regenerate();
            
            if (Auth::user()->role == 'teacher') {
                return redirect()->route('t_home');
            } elseif (Auth::user()->role == 'student') {
                return redirect()->route('s_home');
            } elseif (Auth::user()->role == 'admin') {
                return redirect()->route('admin');
            }
        }
        return redirect()->route('welcome');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('welcome');
    }
    // public function delete($id){
    //     User::where('id' , $id)->delete();
    //     User::destroy($id);
    // }
}


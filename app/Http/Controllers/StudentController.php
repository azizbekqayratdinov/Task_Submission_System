<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function student_home()
    {
        $subjects = DB::table('users')
        ->where('users.id' , Auth::user()->id)
        ->join('students' , 'students.user_id' , '=' , 'users.id')
        ->join('subjects' , 'subjects.id', '=' , 'students.subject_id')
        ->select('students.teacher_id' , 'subjects.name as subject_name' , 'subjects.id as subject_id')
        ->get();
        return view('student.home' , compact('subjects'));
    }
    public function add_student_page()
    {
        $groups = Group::all();
        return view('admin.add_student', compact('groups'));
    }
    public function add_student(Request $request)
    {
        $user = [
            'group_id' => $request->group_id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => "student"
        ];
        $user = User::create($user);
        Auth::login($user);
        return redirect()->route('admin');
    }
    
}

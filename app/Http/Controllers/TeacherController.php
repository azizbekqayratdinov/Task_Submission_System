<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class TeacherController extends Controller
{
    public function teacher_home()
    {
        $groups = DB::table('users')
        ->where('users.id', Auth::user()->id)
        ->join('teachers', 'teachers.teacher_id', '=', 'users.id')
        ->join('groups', 'groups.id', '=', 'teachers.group_id')
        ->join('subjects', 'subjects.id', '=', 'teachers.subject_id')
        ->select('groups.name as group_name', 'subjects.name as subject_name' , 'groups.id as group_id', 'subjects.id as subject_id')
        ->get();
        return view('teacher.home' , compact('groups' ));
    }
    public function add_teacher_page()
    {
        return view('admin.add_teacher');
    }
    public function add_teacher(Request $request)
    {
        $user = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => "teacher"
        ];
        $user = User::create($user);
        Auth::login($user);
        return redirect()->route('admin');
    }
    public function t_group()
    {
        $teachers = User::where('role', 'teacher')->get();
        $subjects = Subject::all();
        $groups = Group::all();
        return view('admin.add_group_to_teacher', compact('teachers',  'groups'));
    }
    public function t_group_store(Request $request)
    {
        Teacher::create([
            'teacher_id' => $request->teacher_id,
            'subject_id' => $request->subject_id,
            'group_id' => $request->group_id,
        ]);
        $users = User::all();
        foreach ($users as $student) {
            if ($student->group_id == $request->group_id) {
                Student::create([
                    'user_id' => $student->id,
                    'teacher_id' => $request->teacher_id,
                    'subject_id' => $request->subject_id,
                    'group_id' => $request->group_id,
                ]);
            }
        }
        return redirect()->route('admin');
    }

    public function score_store(Request $request  , $work_id , $subject_id , $group_id){
        Work::where('id' , $work_id)->update([
            'score'=>$request->score
        ]);
        return redirect()->route('teacher_kursovoy' , compact('group_id' , 'subject_id' ));
    }
    
}

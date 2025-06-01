<?php

namespace App\Http\Controllers;

use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WorkController extends Controller
{
    public function kurs_page($group_id, $subject_id)
    {
        $groups = DB::table('users')
            ->where('users.id', Auth::user()->id)
            ->join('teachers', 'teachers.teacher_id', '=', 'users.id')
            ->join('groups', 'groups.id', '=', 'teachers.group_id')
            ->join('subjects', 'subjects.id', '=', 'teachers.subject_id')
            ->select('groups.name as group_name', 'subjects.name as subject_name', 'groups.id as group_id', 'subjects.id as subject_id')
            ->get();

        $works = DB::table('works')
            ->where('works.subject_id', $subject_id)
            ->where('works.group_id', $group_id)
            ->join('users', 'users.id', '=', 'works.student_id')
            ->select('users.name as user_name', 'works.created_at as date', 'works.score' , 'works.file_name' , 'works.id as work_id' , 'works.subject_id' , 'works.group_id')
            ->get();
        $i = 1;
        return view('teacher.kursoviye', compact('groups', 'group_id', 'subject_id' , 'works' , 'i'));
    }
    public function work($subject_id)
    {
        $subjects = DB::table('users')
            ->where('users.id', Auth::user()->id)
            ->join('students', 'students.user_id', '=', 'users.id')
            ->join('subjects', 'subjects.id', '=', 'students.subject_id')
            ->select('students.teacher_id', 'subjects.name as subject_name', 'subjects.id as subject_id')
            ->get();

        $works = DB::table('works')
            ->where('works.subject_id', $subject_id)
            ->where('works.group_id', Auth::user()->group_id)
            ->where('works.student_id' , Auth::user()->id)
            ->join('users', 'users.id', '=', 'works.student_id')
            ->select('users.name as user_name', 'works.created_at as date', 'works.score' , 'works.file_name' , 'works.id as work_id' , 'works.subject_id' , 'works.group_id')
            ->get();
        $i = 1;

        $work = Work::all();


        return view('student.work', compact('subjects', 'subject_id' , 'work' , 'works' , 'i'));
    }
    public function work_send(Request $request)
    {
        $file_name = date('Y_d_m_h_i_s') . '_' . ($request->file->getClientOriginalName());
        $request->file->move(public_path('/files'), $file_name);
        Work::create([
            'student_id' => Auth::user()->id,
            'group_id' => Auth::user()->group_id,
            'subject_id' => $request->subject_id,
            'file_name' => $file_name
        ]);
        return redirect()->route('s_home');
    }
}

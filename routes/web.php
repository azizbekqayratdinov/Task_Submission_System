<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkController;
use App\Models\User;
use Illuminate\Routing\RouteParameterBinder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned tothe "web" middleware group. Make something great!
|
*/
 
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::controller(UserController::class)->group(function(){
    Route::get('/admin' , 'admin_page')->name('admin')->middleware('auth');
    Route::post('/admin/home' , 'login_store')->name('l_store');
    Route::get('/logout' , 'logout')->name('logout');
});

Route::controller(TeacherController::class)->group(function(){
    Route::get('/teacher' , 'teacher_home')->name('t_home')->middleware('auth');
    Route::get('/teacher/groups' , 't_group')->name('t_group')->middleware('auth');
    Route::post('/teacher/groups' , 't_group_store')->name('tg_store');
    Route::get('teacher/add' , 'add_teacher_page')->name('add_teacher')->middleware('auth');
    Route::post('/teacher/add' , 'add_teacher')->name('add_teacher_store');
    // Route::get('/group_teachers' , 'group_teachers')->name('g_t');
    Route::post('/teacher/score/{work_id}/{group_id}/{subject_id}' , 'score_store')->name('score_store');
    
});

Route::controller(WorkController::class)->group(function(){
    Route::get('/teacher/kursovoy/{group_id}/{subject_id}' , 'kurs_page')->name('teacher_kursovoy');
    Route::get('/student/kursovoy/{subject_id}' , 'work')->name('work')->middleware('auth');
    Route::post('/student/work' , 'work_send')->name('work_send');
    // Route::get('/teacher/works/{subject_id}/{group_id}' , 'student_works')->name('s_work');
});

Route::controller(StudentController::class)->group(function(){
    Route::get('/student' , 'student_home')->name('s_home')->middleware('auth');
    Route::get('/student/add' , 'add_student_page')->name('add_student')->middleware('auth');
    Route::post('/student/add' , 'add_student')->name('add_student_store');
    Route::get('/student/subjects' , 'subjects')->name('subjects')->middleware('auth');
});










// Route::get('/login' , function(){
//     $user = User::create([
//         'name'=>"Adminbek",
//         'email'=>"admin@gmail.com",
//         'password'=>Hash::make('111'),
//         'role'=>"admin"
//     ]);
//     Auth::login($user);
//     return view('welcome');
// }); 


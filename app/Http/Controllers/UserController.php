<?php
namespace App\Http\Controllers;

use App\Models\ClassesUser;
use App\Models\Subjects;
use App\Models\SubjectsUser;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Classes;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
        $classes = Classes::all();
        return view('classes.student', ['id' => $id, 'classes' => $classes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function showAll()
    {

        $users = User::all('*');
        $classes = Classes::all('*');
        $classesUser = ClassesUser::all('*');
        $subjects = Subjects::all();
        $subjectsUser = SubjectsUser::all();
        $teachers = $users->filter(function ($user) {
            $roles = $user?->roles->pluck('name') ?? collect([]);

            return $roles->contains('teacher');
        });


        $students = $users->filter(function ($user) {
            $roles = $user?->roles->pluck('name') ?? collect([]);

            return $roles->contains('student');
        });

        return view('dashboard', [
            'teachers' => $teachers,
            'students' => $students,
            'subjects' => $subjects,
            'classes' => $classes,
            'subjectsUser' => $subjectsUser,
            'classesUser' => $classesUser,
        ]);
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $classesUser = ClassesUser::create([
            'user_id' => $id,
            'classes_id' => $request->classes_id
        ]);


        return redirect('/dashboard')->with('Usuário anexado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

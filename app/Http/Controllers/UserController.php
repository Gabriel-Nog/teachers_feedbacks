<?php
namespace App\Http\Controllers;

use App\Models\Subjects;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Classes;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

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
        $subjects = Subjects::all();
        $teachers = $users->filter(function ($user) {
            $roles = $user->roles;
            return $roles->count() > 0 && $roles->contains('teacher');
        });
        $students = $users->filter(function ($user) {
            $roles = $user->roles;
            return $roles->count() > 0 && $roles->contains('student');
        });

        dd($teachers, $students);

        return view('dashboard', ['teachers' => $teachers, 'students' => $students, 'subjects' => $subjects, 'classes' => $classes]);
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

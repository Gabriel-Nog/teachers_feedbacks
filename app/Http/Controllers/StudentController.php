<?php

namespace App\Http\Controllers;

use App\Models\ClassesUser;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
    //    user = User::with(['classeAsParticipant'])->where('id', $id)->first();
    //     $classesUser = ClassesUser::where([
    //         'user_id' => $id,
    //         'classes_id' => $user->classes_id
    //     ]);
        
    //     $teachersInClass = Teacher::where(['classes_id', $classesUser->classes_id]);

    //     return view('classes.student', ['teachersInClass' => $teachersInClass]); $
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function createByCsvFile(Request $request){

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

<?php

namespace App\Http\Controllers;

use App\Models\Subjects;
use App\Models\User;
use Illuminate\Http\Request;

class SubjectController extends Controller
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

    /**
     * Store a newly created resource in storage.
     */
    public function create()
    {

        $teachers = User::where([['role_id', '=', '2']])->get();
        $professors = [];


        foreach ($teachers as $teacher) {
            if (!$teacher->subjectAsParticipant) {
                array_push($professors, $teacher);
            }
        }

        return view('subjects.subjectsRegister', ['users' => $professors]);
    }
    public function store(Request $request)
    {
        $subject = new Subjects;
        $subject->name = $request->name;
        $subject->user_id = $request->user_id;

        $subject->save();

        return redirect()
            ->route('dashboard')
            ->with('msg', 'Disciplina Criada Com Sucesso!');
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

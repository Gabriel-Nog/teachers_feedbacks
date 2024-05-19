<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\ClassesUser;
use App\Models\Student;
use App\Models\Subjects;
use App\Models\SubjectsUser;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
        $classes = Classes::all();
        $subjects = Subjects::all();
        $user = User::where('id', $id)->with(['subjectAsParticipant', 'classeAsParticipant']);

        return view('classes.attach-teacher', ['id' => $id, 'subjects' => $subjects, 'classes' => $classes, 'user' => $user->first()]);
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

        return view('subjects.subjectsRegister', ['users' => $teachers]);
    }
    public function store(Request $request)
    {
        $subject = new Subjects;

        $subjectId = $subject->insertGetId([
            'name' => $request->name
        ]);


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


        $subject = Subjects::where('id', $request->subjects_id)->get();

        if ($request->classes_id) {
            $classesUser = ClassesUser::where('classes_id',$request->classes_id)->update([
                'user_id' => $id,
                'subject' => $subject->first()->name
            ]);

        }


        if ($request->subjects_id) {
            $subjectsUser = SubjectsUser::updateOrCreate([
                'user_id' => $id,
                'subjects_id' => $request->subjects_id
            ]);
        }

        //Resgata a Classe em questão
        $classesId = ClassesUser::where('classes_id',$request->classes_id)->first();
        //Resgata a Disciplina em questão
        $subjectId = $subject[0]->id;
        //Resgata o usuário em questão
        $userAttached = User::where('id', $subjectsUser->user_id)->first();
        


        //Confirmação de Roles;
        $teacher = 2;

        //Inserindo nas model de Teacher e Student;
        if( $userAttached->role_id == $teacher ){
            $userAttached = Teacher::updateOrInsert(
                ['user_id' =>  $userAttached->id],
                ['classes_id' => $classesId->classes_id, 'subject_id' => $subjectId, 'role_id' =>  $userAttached->role_id, 'created_at' => now(), 'updated_at' =>now()]
            );

        }


        return redirect()->route('dashboard')->with('Usuário anexado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

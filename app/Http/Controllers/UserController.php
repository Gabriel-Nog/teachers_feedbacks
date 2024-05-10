<?php
namespace App\Http\Controllers;

use App\Models\ClassesUser;
use App\Models\Feedback;
use App\Models\Subjects;
use App\Models\SubjectsUser;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
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
        $classes = Classes::all()->filter(
            function($class){
                return $class -> teacherClasses->count() > 0;
            }
        )->map(
            function($class){
                $teacher_userId = $class->teacherClasses->first()->user_id;
                $teacher = User::find($teacher_userId);
                
                $class->teacher_name = $teacher->name;
                return $class;
            }
        );

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
        $user = User::with(['classeAsParticipant'])->where('id', $id)->first();
        // $likes = $user->professorAsFeedback->where('like', '>=', 1)->count();
        // $unlikes = $user->professorAsFeedback->where('dislike', '>=', 1)->count();
        $classesUser = ClassesUser::where('user_id', $user->id)->get();
        // , 'likes' => $likes, 'unlikes' => $unlikes
        if (Auth::user()->roles->first()->name == 'student') {
            $classesUserStudent = ClassesUser::where('user_id', Auth::user()->id)->get()->first();
            $classesUser = $classesUser->filter(function ($c) use ($classesUserStudent) {
                return $c->classes_id == $classesUserStudent->classes_id;
            });
        }
        return view('classes.view-classes', ['user' => $user, 'classesUser' => $classesUser]);
    }

    
    public function showAll()
    {
        $counter = 0; // Inicializa o contador
        // Dentro do loop ou lógica:
        $amount = $counter; // Atribui o valor do contador a $amount
        $counter++;
        $users = User::all('*');
        $classes = Classes::all('*');
        $classesUser = ClassesUser::all('*');
        $subjects = Subjects::all();
        $subjectsUser = SubjectsUser::all();

        $teachers = $users->filter(function ($user) {
            $roles = $user?->roles->pluck('name') ?? collect([]);

            return $roles->contains('teacher');
        })->map(function ($teacher) {
            $teacher->emails_feedbacks = $teacher->professorAsFeedback->pluck('user_email')->toArray();
            return $teacher;


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
                'amount' => $amount
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
        $doesUserAlreadyHaveAClass = ClassesUser::where('user_id', $id)->get()->first();
        if ($doesUserAlreadyHaveAClass) {
            $classesUser = ClassesUser::where('user_id', $id)->update([
                'classes_id' => $request->classes_id
            ]);
        } else {
            $classesUser = ClassesUser::create([
                'user_id' => $id,
                'classes_id' => $request->classes_id
            ]);
            $userAttached = User::where('id', $classesUser->user_id)->first();
            $student = 3;

            if ($userAttached->role_id == $student) {
                $userAttached = Student::updateOrInsert(
                    ['user_id' => $userAttached->id],
                    ['classes_id' => $classesUser->classes_id, 'role_id' => $userAttached->role_id, 'created_at' => now(), 'updated_at' => now()]
                );
            }   
            return redirect()->route('dashboard')->with('msg', 'Usuário anexado com sucesso!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

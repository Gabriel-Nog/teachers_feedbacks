<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use App\Models\Teacher;
use App\Providers\RouteServiceProvider;
use App\Rules\CPF;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $roles = DB::table('roles')->get();
        
        $namesTranslate = [];

        foreach ($roles as $role){
            if($role->name == "teacher"){
                $nameTranslate = "Professor";
            }else if($role->name == "student"){
                $nameTranslate = "Aluno";
            }else{
                $nameTranslate = "Administrador do Sistema";
            }
            array_push($namesTranslate, $nameTranslate);
        }
        
        return view('auth.register', ['roles' => $roles,'namesTranslate'=> $namesTranslate]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'cpf' => ['required', new CPF],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'role_id' => ['required', 'int'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);


        $request['cpf'] = preg_replace('/[^0-9]/', '', $request->cpf);


        $role = Role::findOrFail($request->role_id);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'email_verified_at' => now(),
            'cpf' => $request->cpf,
            'role_id' => $request->role_id,
            'password' => Hash::make($request->password),
        ]);

        $userId = $user->id;

        if($request->role_id == 2){
             Teacher::create([
                'role_id' => $request->role_id,
                'user_id' =>$userId,
            ]);
        }elseif($request->role_id == 3){
             Student::create([
                'role_id' => $request->role_id,
                'user_id' => $userId,
            ]);
        }


        $user->assignRole($role);
        event(new Registered($user));

        return redirect()->route('dashboard')->with('msg', 'Usuário criado com sucesso!');
    }
}

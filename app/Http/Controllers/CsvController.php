<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\ClassesUser;
use App\Models\Student;
use App\Models\Subjects;
use App\Models\SubjectsUser;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\File;
use Spatie\Permission\Models\Role;

class CsvController extends Controller
{
    // TODO: Adicionar o commit do joão
    public function index()
    {
        $users = User::latest();
        $classes = Classes::latest();
        $subjects = Subjects::latest();
        return view('csv.add-csv', ['users' => $users, 'classes' => $classes, 'subjects' => $subjects]);
    }

    public function importUserCsv(Request $request)
    {

        $request->validate([
            'type' => 'required',
            'csvInput' => 'required',
        ]);

        if ($request->hasFile('csvInput') && $request->csvInput->getClientOriginalExtension() == 'csv') {
            // dd($request->type);
            $file = $request->file('csvInput');
            $handle = fopen($file->path(), 'r');

            fgetcsv($handle, null, ';');

            $chunkSize = 3;

            while (!feof($handle)) {
                $chunkData = [];

                for ($i = 0; $i < $chunkSize; $i++) {

                    $data = fgetcsv($handle, null, ';');

                    if ($data == false || $data == null) {
                        break;
                    }

                    array_push($chunkData, $data);
                }

                switch ($request->type) {
                    case 'user':
                        $this->createUser($chunkData);
                        break;
                    case 'class':
                        $this->createClass($chunkData);
                        break;
                    case 'subject':
                        $this->createSubejct($chunkData);
                        break;
                }
            }


            fclose($handle);
            return redirect()->route('dashboard')->with('msg', 'Arquivo adicionado com sucesso!');
        } else {
            return redirect()->back()->withErrors(['csvInput' => 'Arquivo inválido!']);
        }

    }


    protected function createUser($chunkData)
    {
        foreach ($chunkData as $line) {
            $user = $line;

            $role = 0;

            switch (strtolower($user[4])) {
                case 'aluno':
                    $role = 3;
                    break;
                case 'professor':
                    $role = 2;
                    break;
                default:
                    $role = 3;
                    break;
            }

            $user = User::create([
                "name" => $user[0],
                "email" => $user[1],
                "cpf" => $user[2],
                'password' => Hash::make($user[3]),
                'role_id' => $role
            ]);

            $roleRelation = Role::findOrFail($role);

            $user->assignRole($roleRelation);
            event(new Registered($user));

            if ($role == 3) {
                Student::create([
                    'user_id' => $user->id,
                    'role_id' => $role
                ]);
            } else {
                Teacher::create([
                    'user_id' => $user->id,
                    'role_id' => $role
                ]);
            }
        }
    }

    protected function createClass($chunkData)
    {
        foreach ($chunkData as $line) {
            $class = $line;

            Classes::create([
                "name" => $class[0],
                "shift" => $class[1],
                "year" => $class[2],
            ]);
        }
    }

    protected function createSubejct($chunkData)
    {
        foreach ($chunkData as $line) {
            $subject = $line;
            Subjects::create([
                "name" => $subject[0],
            ]);
        }
    }

}

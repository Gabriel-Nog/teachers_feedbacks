<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CsvController extends Controller
{
    public function index()
    {
        return view('csv.add-csv');
    }

    public function importUserCsv(Request $request)
    {
        // $request->validate([
        //     'csv-input' => 'required|mimes:csv',
        // ]);
        //read csv file and skip data
        $file = $request->file('csvInput');
        $handle = fopen($file->path(), 'r');

        //skip the header row
        fgetcsv($handle);


        $chunkSize = 200;
        while (!feof($handle)) {
            $chunkData = [];

            for ($i = 0; $i < $chunkSize; $i++) {
                $data = fgetcsv($handle);

                if ($data == false) {
                    break;
                }

                $chunkData[] = $data;
            }

            $this->createUser($chunkData);
        }

        fclose($handle);
    }
    public function createUser($chunkData)
    {


        foreach ($chunkData as $line) {
            $user = $line;

            $role = 0;
            switch ($user[3]) {
                case 'Aluno':
                    $role = 3;
                    break;
                case 'Professor':
                    $role = 2;
                    break;
                default:
                    $role = 3;
                    break;
            }

            User::create([
                "name" => $user[0],
                "email" => $user[1],
                "cpf" => $user[2],
                'password' => $user[3],
                'role_id' => $role
            ]);
        }
    }
}

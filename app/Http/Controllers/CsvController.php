<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CsvController extends Controller
{
    public function index()
    {
        return view('csv.add-csv');
    }

    public function createUserByCsvFile(Request $request){

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classes;
use Illuminate\Support\Facades\DB;

class ClassesController extends Controller
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
        $subjects = DB::table('subjects')->get();
        return view('classes.classesRegister', ['subjects'=> $subjects]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $classes = new Classes;
        $classes -> name = $request -> name;
        $classes -> shift = $request -> shift;
        $classes -> year = $request -> year;
        $classes-> subjects_id = $request->subject;
        $classes ->user_id = auth()->user()->id;
        $classes->save();

        return redirect()
            ->route('dashboard')
            ->with('msg', 'Turma Criada Com Sucesso!');
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

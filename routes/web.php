<?php

use App\Http\Controllers\CsvController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\FeedbackController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AuthenticatedSessionController::class, 'create'])
    ->name('login');



Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [UserController::class, 'showAll'])->name('dashboard');
    Route::group(['middleware' => ['can:create student']], function () {
        // Disciplinas
        Route::get('/Registro-de-disciplinas/criar', [SubjectController::class, 'create'])->name('subjects.subjectsRegister');
        Route::post('/Registro-de-disciplinas/gravar', [SubjectController::class, 'store'])->name('subjects.subjectsRegister.store');
        // Turmas
        Route::get('/Registro-de-turmas/criar', [ClassesController::class, 'create'])->name('classes.classesRegister');
        Route::post('/Registro-de-turmas/gravar', [ClassesController::class, 'store'])->name('classes.classesRegister.store');
        //Professores
        Route::get('professores/{id}/anexar', [SubjectController::class, 'index'])->name('classes.attach-teacher');
        Route::post('professor/{id}/anexar', [SubjectController::class, 'update'])->name('classes.attach-teachers');
        //Professores anexar
        Route::get('professores/{id}/anexar', [SubjectController::class, 'index'])->name('classes.attach-teacher');
        Route::post('professor/{id}/anexar', [SubjectController::class, 'update'])->name('classes.attach-teachers');
        //Alunos
        Route::get('alunos/{id}/anexar', [UserController::class, 'index'])->name('classes.student');
        Route::post('aluno/{id}/anexar', [UserController::class, 'update'])->name('classes.students');
        //Alunos Anexar
        Route::get('alunos/{id}/anexar', [UserController::class, 'index'])->name('classes.student');
        Route::post('aluno/{id}/anexar', [UserController::class, 'update'])->name('classes.students');
    });

    Route::group(['middleware' => ['can:feedback']], function () {
        Route::post('/feedback/gravar', [FeedbackController::class, 'store'])->name('feedbacks.store');
    });

    Route::group(['middleware' => ['can:view feedback']], function () {
        Route::get('professores/{id}/feedbacks', [FeedbackController::class, 'index'])->name('feedbacks.index');
    });

    Route::group(['miidleware' => ['can:create teacher', 'can:create student']], function () {
        Route::get('criar-usuarios/csv', [CsvController::class, 'index'])->name('csv.add-csv');
    });

    Route::get('professores/{id}/turmas', [UserController::class, 'show'])->name('classes.view-classes');


    Route::get('/perfil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/perfil', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/perfil', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__ . '/auth.php';

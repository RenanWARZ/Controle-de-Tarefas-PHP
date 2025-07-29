<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistrarController;
use App\Http\Controllers\TarefaController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

    // ROTAS DE USUÁRIOS
    Route::get('/', [UsuarioController::class, 'welcome'])->name('welcome');

        Route::get('/usuario', [UsuarioController::class, 'index'])->name('usuario.index');
        Route::get('/show/{usuario}', [UsuarioController::class, 'show'])->name('usuario.show');
        Route::get('/create', [UsuarioController::class, 'create'])->name('usuario.create');
        Route::post('/store', [UsuarioController::class, 'store'])->name('usuario.store');
        Route::get('/edit/{usuario}', [UsuarioController::class, 'edit'])->name('usuario.edit');
        Route::put('/update/{usuario}', [UsuarioController::class, 'update'])->name('usuario.update');
        Route::delete('/destroy/{usuario}', [UsuarioController::class, 'destroy'])->name('usuario.destroy');

        // ROTAS DE TAREFAS
        Route::get('/usuario/{usuario}/tarefas', [TarefaController::class, 'index'])->name('tarefas.index');
        Route::get('/usuario/{usuario}/tarefas/create', [TarefaController::class, 'create'])->name('tarefas.create');
        Route::post('/usuario/{usuario}/tarefas', [TarefaController::class, 'store'])->name('tarefas.store');
        Route::get('/usuario/{usuario}/tarefas/{tarefa}/edit', [TarefaController::class, 'edit'])->name('tarefas.edit');
        Route::get('/usuario/{usuario}/tarefas/{tarefa}', [TarefaController::class, 'show'])->name('tarefas.show');
        Route::match(['put', 'patch'], '/usuario/{usuario}/tarefas/{tarefa}', [TarefaController::class, 'update'])->name('tarefas.update');
        Route::delete('/usuario/{usuario}/tarefas/{tarefa}', [TarefaController::class, 'destroy'])->name('tarefas.destroy');

        // ROTA DE LOGOUT
    Route::post('/logout', [RegistrarController::class, 'destroy'])->name('logout');

//=====================================================================================================================================

// ROTAS DE LOGIN
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('entrar');

// ROTAS DE REGISTRO
Route::get('/registrar', [RegistrarController::class, 'create'])->name('registrar.create');
Route::post('/registrar', [RegistrarController::class, 'store'])->name('registrar.store');

//=====================================================================================================================================

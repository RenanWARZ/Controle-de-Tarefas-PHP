<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Http\Requests\ValidacaoUsuario;
use Illuminate\Support\Facades\Storage;
use App\Models\Setor;
use App\Models\Tarefa;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{

    public function welcome()
    {
        return view('welcome');
    }
    //==========================================================================================================================================================================
    public function index(Tarefa $tarefa)
    {
        // Carrega todos os usuários com suas tarefas

        if(Auth::user()->tipo_user == '1'){
            $usuarios = Usuario::with('tarefas')->get();
        }else{
            $usuarios = Usuario::where('id_user', Auth::user()->id)->with('tarefas')->get();
        }

        if ($tarefa->id) {
            $usuarios = $usuarios->filter(function ($usuario) use ($tarefa) {
                return $usuario->tarefas->contains($tarefa->id);
            });
        }

        return view('usuario.index', ['usuarios' => $usuarios]);
    }
    //==========================================================================================================================================================================

    public function create()
    {
        $setores = Setor::all();
        $tarefas = Tarefa::all();

        return view('usuario.create', compact('setores', 'tarefas'));
    }

    //==========================================================================================================================================================================
    public function store(ValidacaoUsuario $request)
    { /** @var \Illuminate\Http\Request $request */

        $dados = $request->validated();
          // Criptografa a senha
        $dados['password'] = bcrypt($dados['password']);


        $users = Arr::only($dados, ['name', 'email', 'password']);

        $dados['id_user'] = User::create($users)->id; // Cria o usuário no sistema


        if ($request->hasFile('imagem')) {
            $imagem = $request->file('imagem');
            $nomeImagem = uniqid() . '.' . $imagem->getClientOriginalExtension();
            $caminho = $imagem->storeAs('usuarios', $nomeImagem, 'public');
            $dados['foto'] = $caminho;
        }

        // Adiciona tarefa digitada manualmente
        $dados['tarefa_atribuida'] = $request->input('tarefa_atribuida');

        $usuario = Usuario::create($dados);

        return redirect()->route('usuario.index')->with('success', 'Usuário cadastrado com sucesso!');
    }


    //==========================================================================================================================================================================

    public function show(Usuario $usuario)
    {
        $usuario->load('tarefas', 'setor');

        return view('usuario.show', compact('usuario'));
    }

    //==========================================================================================================================================================================

    public function edit(Usuario $usuario)
    {

        $setores = Setor::all();
        $tarefas = Tarefa::all();
        return view('usuario.edit', compact('usuario', 'setores', 'tarefas'));
    }
    //==========================================================================================================================================================================

    public function update(ValidacaoUsuario $request, Usuario $usuario)
    {
        /** @var \Illuminate\Http\Request $request */

        $dados = $request->validated();

        // Se enviou uma nova senha, criptografa
        if (!empty($dados['password'])) {
            $dados['password'] = bcrypt($dados['password']);
        } else {
            unset($dados['password']); // evita sobrescrever com vazio
        }

        // Atualiza imagem, se enviada
        if ($request->hasFile('imagem')) {
            $imagem = $request->file('imagem');
            $nomeImagem = uniqid() . '.' . $imagem->getClientOriginalExtension();
            $caminho = $imagem->storeAs('usuarios', $nomeImagem, 'public');

            // Remove imagem antiga
            if ($usuario->foto && Storage::disk('public')->exists($usuario->foto)) {
                Storage::disk('public')->delete($usuario->foto);
            }

            $dados['foto'] = $caminho;
        }

        // Atualiza o usuário
        $usuario->update($dados);

        // Atualiza tarefas
        if ($request->filled('tarefas')) {
            $usuario->tarefa()->sync($request->tarefas);
        } else {
            $usuario->tarefa()->sync([]);
        }

        return redirect()->route('usuario.index')->with('success', 'Usuário editado com sucesso!');
    }

    //==========================================================================================================================================================================
    public function destroy(Usuario $usuario)
    {
        $this->destroyImg($usuario->foto); // Remove imagem, se existir
        $usuario->delete();

        return redirect()->route('usuario.index')->with('success', 'Usuário apagado com sucesso!');
    }

    //==========================================================================================================================================================================
    public function destroyImg($cover)
    {
        if ($cover && Storage::disk('public')->exists($cover)) {
            Storage::disk('public')->delete($cover);
        }
    }
}

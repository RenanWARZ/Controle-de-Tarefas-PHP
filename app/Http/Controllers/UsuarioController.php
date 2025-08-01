<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Http\Requests\ValidacaoUsuario;
use App\Models\Notificacao;
use Illuminate\Support\Facades\Storage;
use App\Models\Setor;
use App\Models\Tarefa;
use App\Models\tipoUser;
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
    public function sobre()
    {
        return view('sobre');
    }
    //==========================================================================================================================================================================
    public function index(Tarefa $tarefa)
    {
        // Carrega todos os usuários com suas tarefas

        if (Auth::user()->tipo_user == '1') {
            $usuarios = Usuario::with('tarefas')->get();
        } else {
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
        $papeis = tipoUser::all();

        return view('usuario.create', compact('setores', 'tarefas', 'papeis'));
    }

    //==========================================================================================================================================================================
    public function store(ValidacaoUsuario $request)
    {
        /** @var \Illuminate\Http\Request $request */

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
        $usuario->load('tarefas', 'setor', 'user');
        $tipo_user = tipoUser::where('id', $usuario->user->tipo_user)->first('descricao'); //pluck pega somente um campo específico
        return view('usuario.show', compact('usuario', 'tipo_user'));
    }

    //==========================================================================================================================================================================

    public function edit(Usuario $usuario)
    {

        $setores = Setor::all();
        $tarefas = Tarefa::all();
        $papeis = tipoUser::all();

        return view('usuario.edit', compact('usuario', 'setores', 'tarefas', 'papeis'));
    }
    //==========================================================================================================================================================================

    public function update(ValidacaoUsuario $request, Usuario $usuario)
    {
        /** @var \Illuminate\Http\Request $request */

        try {

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

            // Update User
            User::whereId($usuario->id_user)->update([
                'name' => $dados['name'],
                'email' => $dados['email'],
                'password' => $dados['password'] ?? $usuario->user->password, // Mantém a senha antiga se não for atualizada
                'tipo_user' => $dados['papel'],

            ]);

            if (isset($dados['foto'])) {
                Usuario::where('id_user', $usuario->id_user)->update([
                    'foto' => $dados['foto'],
                ]);
            }


            return redirect()->route('usuario.index')->with('success', 'Usuário editado com sucesso!');
            //code...
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    //==========================================================================================================================================================================
    public function destroy(Usuario $usuario)
    {
        if ($usuario->user && $usuario->foto) {
        $this->destroyImg($usuario->foto); // Remove imagem, se existir
    }

        $usuario->user->delete();

        return redirect()->route('usuario.index')->with('success', 'Usuário apagado com sucesso!');
    }

    //==========================================================================================================================================================================
    public function destroyImg($cover)
    {
        if ($cover && Storage::disk('public')->exists($cover)) {
            Storage::disk('public')->delete($cover);
        }
    }
    //===============================================================================================================================================================================
    public function notificacao()
    {
        $user = Auth::user();
        Notificacao::where('usuario_id', $user->id)->update(['lida' => 1]);
        return redirect()->back()->with('success', 'Notificações marcadas como lidas!');
    }
    //==========================================================================================================================================================================
    public function excluirNotificacao()
    {
        Notificacao::where('usuario_id', Auth::id())->delete();

        return redirect()->back()->with('success', 'Notificações apagadas com sucesso!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Mail\TarefaCriada;
use App\Models\Setor;
use App\Models\Tarefa;
use App\Models\Usuario;
use App\Services\NotificacaoServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;



class TarefaController extends Controller
{

    //===================================================================================================================
    public function index(Request $request, $usuarioId = null)
    {
        // dd($usuarioId);
        // dd($request->all());
        try {


            $usuario = '';
            $tarefasQuery = Tarefa::query();
            
            if (!Auth::user()->tipo_user) {
                $usuario = Usuario::with('user')->where('id_user', $usuarioId)->firstOrFail();
            $tarefasQuery->where('usuario_id', $usuarioId);
        }


            $tarefasQuery = $tarefasQuery->orderby('usuario_id')->orderby('prazo');


            if ($request->filled('id')) {
                $tarefasQuery->where('id', $request->id);
            }

            if ($request->filled('task')) {
                $tarefasQuery->where('task', 'like', '%' . $request->task . '%');
            }

            if ($request->filled('setor_id')) {
                $setorId = $request->setor_id;
                $tarefasQuery->whereHas('usuario', function ($query) use ($setorId) {
                    $query->where('setor_id', $setorId);
                });
            }

            //Buscar prazo pela data que está na banco de dados (whereBetween) e convertendo o formato
            if ($request->filled('prazo') && $request->filled('prazofinal')) {
                $dataInicio = date('Y-m-d', strtotime($request->prazo));
                $dataFinal = date('Y-m-d', strtotime($request->prazofinal));
                $tarefasQuery->whereBetween('prazo', [$dataInicio, $dataFinal]);
            }

            if ($request->filled('busca')) {
                $total = $request->busca;
                $tarefasQuery->where(function ($query) use ($total) {
                    $query->where('task', 'like', "%{$total}%")
                        ->orWhere('descricao', 'like', "%{$total}%");
                });
            }

            $tarefas = $tarefasQuery->paginate(20)->withQueryString();


            $tarefa = null;
            if ($request->filled('id') || $request->filled('task') || $request->filled('busca') || $request->filled('setor_id')) {
                $tarefa = $tarefas->first();
            }

            // dd($tarefa, $tarefas);

            $setores = Setor::orderBy('nome')->get();
            return view('tarefas.index', compact('usuario', 'tarefas', 'tarefa', 'setores'));
            //code...
        } catch (\Throwable $th) {
            dd ($th);
        }
    }

    //===================================================================================================================

    public function create()
    {
        $usuarios = Usuario::with('user')->get();
        return view('tarefas.create', compact('usuarios'));
    }
    //===================================================================================================================
    public function store(Request $request)
    {

        $request->validate([
            'task' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'prazo' => 'required|date',
            'prazofinal' => 'required|date',
        ]);

        try {
            $tarefa = Tarefa::create([
                'task' => $request->task,
                'descricao' => $request->descricao,
                'prazo' => $request->prazo,
                'prazofinal' => $request->prazofinal,
                'usuario_id' => $request->usuario_id,
            ]);
        } catch (\Throwable $th) {
            dd($th);
        }


        $notificacao = new NotificacaoServices($request->usuario_id, 'Nova Tarefa Atribuída', 'Você recebeu uma nova tarefa: ' . $tarefa->task);

        $notificacao->cadastrarNotificacao();

        // Envia o e-mail
        // Mail::to($usuario->email)->send(new TarefaCriada($tarefa));

        return redirect()->route('tarefas.index', Auth::user()->id)->with('success', 'Tarefa atribuída e e-mail enviado!');
    }
    //===================================================================================================================

    public function destroy(Tarefa $tarefa)
    {

        if(Auth::user()->tipo_user){
            $tarefa->delete();
        }else{
             return back()->with('errors', 'Você não tem permisssão para isso!');
        }

        return back()->with('success', 'Tarefa deletada com sucesso!');
    }
    //===================================================================================================================

    public function update(Request $request, Usuario $usuario, Tarefa $tarefa)
    {

        $tarefa->concluida = $request->has('concluida'); // true se marcado, false se não
        $tarefa->save();

        $request->validate([
            'task' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'prazo' => 'required|date',
            'prazofinal' => 'required|date',
        ]);

        $tarefa->update([
            'task' => $request->task,
            'descricao' => $request->descricao,
            'prazo' => $request->prazo,
            'prazofinal' => $request->prazofinal,
        ]);

        // Envia o e-mail
        // Mail::to($usuario->email)->send(new TarefaCriada($tarefa));

        return redirect()->route('tarefas.index', isset($usuario->id) ? $usuario->id : 0)->with('success', 'Tarefa atualizada e email enviado com sucesso!');
    }
    //===================================================================================================================

    public function edit(Usuario $usuario, Tarefa $tarefa)
    {
        return view('tarefas.edit', compact('usuario', 'tarefa'));
    }

    //===================================================================================================================
    public function show(Usuario $usuario, Tarefa $tarefa)
    {
        return view('tarefas.show', compact('usuario', 'tarefa'));
    }
    //===================================================================================================================
}

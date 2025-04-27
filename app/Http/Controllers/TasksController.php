<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userId = Auth::id();
        $tasks = Task::where('user_id', $userId)
            ->orderBy('is_completed')
            ->orderBy('priority', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $totalTasks = Task::where('user_id', $userId)->count();

        $totalCompleted = Task::where('user_id', $userId)
            ->where('is_completed', true)
            ->count();

        return view('tasks.index')
            ->with('tasks', $tasks)
            ->with('totalTasks', $totalTasks)
            ->with('totalCompleted', $totalCompleted);
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    public function store(StoreTaskRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();


        if ($request->hasFile('arquivo')) {
            $data['arquivo'] = file_get_contents($request->file('arquivo')->getRealPath());
        }

        //Faz o tratamento para não estourar exceção no banco
        $data['category'] = $data['category'] ?? 'Outro';

        Task::create($data);

        return redirect()->route('tasks.index')->with('success', 'Tarefa criada com sucesso!');
    }

    public function complete(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        $task->is_completed = true;
        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Tarefa marcada como concluída!');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')
            ->with('success', "Tarefa '{$task->title}' removida com sucesso");
    }

    public function update(StoreTaskRequest $request, Task $task)
    {
        $data = $request->validated();

        if ($request->hasFile('arquivo')) {
            $data['arquivo'] = file_get_contents($request->file('arquivo')->getRealPath());
        }

        $data['category'] = $data['category'] ?? 'Outro';

        $task->update($data);

        return redirect()->route('tasks.index')->with('success', 'Tarefa atualizada com sucesso!');
    }
}

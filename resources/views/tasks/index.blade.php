@extends('layouts.app')

@section('title', 'Lista de Tarefas')

@section('content')
<div class="px-3">
<div class="d-flex align-items-center justify-content-between">
    <h1 class="mb-4">Tarefas</h1>
    <a href="/tasks/create" class="btn btn-primary d-flex align-items-center gap-1">
        <i class="ph ph-plus-circle" style="font-size: 1.25rem;"></i>
        Criar tarefa
    </a>
</div>


    @if ($tasks->isEmpty())
        <div class="alert alert-info">
            Nenhuma tarefa cadastrada.
        </div>
    @else
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Título</th>
                    <th>Descrição</th>
                    <th>Categoria</th>
                    <th>Prioridade</th>
                    <th>Data de Entrega</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                    <tr class="{{ $task->is_completed ? 'table-success' : '' }}">
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->description }}</td>
                        <td>{{ $task->category }}</td>
                        <td>{{ $task->priority }}</td>
                        <td>{{ \Carbon\Carbon::parse($task->due_date)->format('d/m/Y') }}</td>
                        <td>
                            @if (!$task->is_completed)
                                <form action="{{ route('tasks.complete', $task->id_task) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-secondary">Concluir</button>
                                </form>
                            @else
                                <span class="btn btn-sm btn-success">Concluída</span>
                            @endif
                        </td>
                        <td class="d-flex align-items-center gap-2">
                            <form action="{{ route('task.destroy', $task->id_task) }}" method="post">
                                @csrf
                                @method('DELETE')
                            <button class="btn btn-outline-danger d-flex align-items-center"><i class="ph ph-trash" style="font-size: 1.25rem"></i></button>
                        </form>

                        <button type="submit" class="btn btn-outline-warning btn-sm d-flex align-items-center"><i class="ph ph-pencil" style="font-size: 1.25rem;"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center mt-4">
            {{ $tasks->links() }}
        </div>
    </div>
    @endif
@endsection

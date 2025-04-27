@extends('layouts.app')

@section('title', 'Lista de Tarefas')

@section('content')
    <div class="container">
        <div class="d-flex align-items-center justify-content-between mb-2">
            <h1 style="margin-bottom: 0;">Tarefas</h1>
            <a href="/tasks/create" class="btn btn-primary d-flex align-items-center gap-1">
                <i class="ph ph-plus-circle" style="font-size: 1.25rem;"></i>
                Criar tarefa
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="container mt-2">
            <div class="alert alert-success alert-dismissible fade show" role="alert" id="alert-success">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif


    @if ($tasks->isEmpty())
        <div class="container">
            <div class="alert alert-info">
                Nenhuma tarefa cadastrada.
                <strong>Clique em "Criar tarefa" para criar uma tarefa agora.</strong>
            </div>
        </div>
    @else
        <div class="container">
            <div class="tasks-info-container py-3 mb-2 bg-light d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-semibold text-primary">
                    Total de Tarefas:
                    <span class="badge bg-primary">{{ $totalTasks }}</span>
                </h5>
                <h5 class="mb-0 fw-semibold text-success">
                    Concluídas:
                    <span class="badge bg-success">{{ $totalCompleted }}/{{ $totalTasks }}</span>
                </h5>
            </div>

            @foreach ($tasks as $task)
                <div class="task-item {{ $task->is_completed ? 'task-finished' : '' }}">
                    <div class="first-row">
                        <div class="first-col">
                            <div class="title-container">
                                <form action="{{ route('tasks.complete', $task->id_task) }}" method="POST"
                                    id="form-complete-{{ $task->id_task }}">
                                    @csrf
                                    @method('PATCH')
                                    <label class="custom-checkbox {{ $task->is_completed ? 'disabled' : '' }}">
                                        <input type="checkbox" name="is_completed"
                                            onchange="document.getElementById('form-complete-{{ $task->id_task }}').submit()"
                                            {{ $task->is_completed ? 'disabled' : '' }}
                                            {{ $task->is_completed ? 'checked' : '' }}>
                                        <span class="checkmark"></span>
                                    </label>
                                </form>

                                <p class="task-title {{ $task->is_completed ? 'done' : '' }}">{{ $task->title }}</p>
                            </div>
                            <div class="category-container">
                                @if (trim($task->category) === 'Estudo')
                                    <span class="badge rounded-pill text-bg-primary">
                                        {{ $task->category }}
                                    </span>
                                @elseif (trim($task->category) === 'Trabalho')
                                    <span class="badge rounded-pill text-bg-secondary">
                                        {{ $task->category }}
                                    </span>
                                @elseif (trim($task->category) === 'Pessoal')
                                    <span class="badge rounded-pill text-bg-info">
                                        {{ $task->category }}
                                    </span>
                                @elseif (trim($task->category) === 'Outro')
                                    <span class="badge rounded-pill text-bg-dark">
                                        {{ $task->category }}
                                    </span>
                                @endif
                                <div class="priority-container">
                                    @if ($task->priority === 1)
                                        <span class="badge rounded-pill text-bg-secondary">
                                            Baixa
                                        </span>
                                    @elseif ($task->priority === 2)
                                        <span class="badge rounded-pill text-bg-primary">
                                            Média
                                        </span>
                                    @elseif ($task->priority === 3)
                                        <span class="badge rounded-pill text-bg-danger">
                                            Alta
                                        </span>
                                    @endif
                                    @if (\Carbon\Carbon::parse($task->due_date)->isPast() && !$task->is_completed)
                                        <span class="badge rounded-pill text-bg-danger">
                                            ATRASADA
                                        </span>
                                    @endif
                                </div>
                                <div class="date-container">
                                    {{ \Carbon\Carbon::parse($task->due_date)->format('d/m/Y') }}
                                </div>
                            </div>
                        </div>
                        <div class="button-container">
                            <a href="{{ route('tasks.show', $task) }}" class="btn btn-outline-info btn-sm btn-show"
                                title="Ver Detalhes">
                                <i class="ph ph-eye" style="font-size: 1.25rem;"></i>
                            </a>

                            <form action="{{ route('task.destroy', $task->id_task) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-outline-danger btn-sm" title="remover tarefa"
                                    {{ $task->is_completed ? 'disabled' : '' }}><i class="ph ph-trash"
                                        style="font-size: 1.25rem"></i></button>
                            </form>
                            <form action="{{ route('tasks.edit', $task) }}" method="GET">
                                <button class="btn btn-outline-warning btn-sm" {{ $task->is_completed ? 'disabled' : '' }}
                                    title="Editar tarefa">
                                    <i class="ph ph-pencil" style="font-size: 1.25rem;"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="d-flex justify-content-center mt-4">
                {{ $tasks->links() }}
            </div>
        </div>
    @endif
@endsection

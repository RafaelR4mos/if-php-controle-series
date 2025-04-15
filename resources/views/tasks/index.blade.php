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


    @if ($tasks->isEmpty())
        <div class="alert alert-info">
            Nenhuma tarefa cadastrada.
        </div>
    @else
        <div class="container">
            <div class="tasks-info-container py-3 mb-2 bg-light d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-semibold text-primary">
                    Total de Tarefas:
                    <span class="badge bg-primary">{{ count($tasks) }}</span>
                </h5>
                <h5 class="mb-0 fw-semibold text-success">
                    Concluídas:
                    <span class="badge bg-success">{{ $totalCompleted }}/{{ count($tasks) }}</span>
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
                                <div>
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
                                </div>
                                <div class="date-container">
                                    {{ \Carbon\Carbon::parse($task->due_date)->format('d/m/Y') }}</div>
                            </div>
                        </div>
                        <div class="button-container">
                            <form action="{{ route('task.destroy', $task->id_task) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-outline-danger btn-sm" title="remover tarefa"
                                    {{ $task->is_completed ? 'disabled' : '' }}><i class="ph ph-trash"
                                        style="font-size: 1.25rem"></i></button>
                            </form>
                            <button type="submit"
                                class="btn btn-outline-warning btn-sm {{ $task->is_completed ? 'disabled' : '' }}"
                                title="editar tarefa"><i class="ph ph-pencil" style="font-size: 1.25rem;"></i></button>
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

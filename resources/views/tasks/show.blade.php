@extends('layouts.app')

@section('content')
    <div class="custom-container">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('tasks.index') }}">Tarefas</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detalhes da Tarefa</li>
                </ol>
            </nav>

            <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary">
                <i class="ph ph-arrow-left"></i> Voltar
            </a>
        </div>

        <h2 class="mb-4">Detalhes da Tarefa</h2>

        <div class="card shadow-sm">
            <div class="card-body">
                <h4 class="card-title mb-3">{{ $task->title }}</h4>

                <div class="mb-3">
                    <strong>Descrição:</strong><br>
                    <p class="text-muted">{{ $task->description ?? 'Nenhuma descrição fornecida.' }}</p>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Categoria:</strong><br>
                        <span
                            class="badge rounded-pill
                            @if ($task->category === 'Estudo') text-bg-primary
                            @elseif($task->category === 'Trabalho') text-bg-secondary
                            @elseif($task->category === 'Pessoal') text-bg-info
                            @else text-bg-dark @endif">
                            {{ $task->category ?? 'Não categorizado' }}
                        </span>
                    </div>

                    <div class="col-md-6">
                        <strong>Prioridade:</strong><br>
                        @switch($task->priority)
                            @case(1)
                                <span class="badge bg-secondary">Baixa</span>
                            @break

                            @case(2)
                                <span class="badge bg-primary">Média</span>
                            @break

                            @case(3)
                                <span class="badge bg-danger">Alta</span>
                            @break

                            @default
                                <span class="badge bg-light text-dark">Não definida</span>
                        @endswitch
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Data Limite:</strong><br>
                        {{ \Carbon\Carbon::parse($task->due_date)->format('d/m/Y') }}
                    </div>

                    <div class="col-md-6">
                        <strong>Status:</strong><br>
                        @if ($task->is_completed)
                            <span class="badge bg-success">Concluída</span>
                        @else
                            <span class="badge bg-warning text-dark">Pendente</span>
                        @endif
                    </div>
                </div>

                <div class="mb-3">
                    <strong>Usuário:</strong><br>
                    {{ $task->user->name ?? 'Usuário não encontrado' }}
                </div>

                @if ($task->arquivo)
                    <div class="mb-3">
                        <strong>Arquivo Anexado:</strong><br>
                        <img src="data:image/png;base64,{{ base64_encode($task->arquivo) }}" alt="Arquivo Anexado"
                            class="img-fluid rounded mt-2" style="max-height: 400px;">
                    </div>
                @else
                    <div class="mb-3">
                        <strong>Arquivo Anexado:</strong><br>
                        <p class="text-muted">Nenhum arquivo enviado.</p>
                    </div>
                @endif
                <hr class="my-4">

                <div class="row">
                    <div class="col-md-2 dt-cricao-container">
                        <strong>Data de Criação:</strong><br>
                        {{ \Carbon\Carbon::parse($task->created_at)->format('d/m/Y H:i') }}
                    </div>

                    <div class="col-md-2">
                        <strong>Última Atualização:</strong><br>
                        {{ $task->updated_at ? \Carbon\Carbon::parse($task->updated_at)->format('d/m/Y H:i') : 'Nunca atualizado' }}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

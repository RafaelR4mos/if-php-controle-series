@extends('layouts.app')

@section('content')
    <div class="custom-container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('tasks.index') }}">Tarefas</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Editar Tarefa</li>
                </ol>
            </nav>

            <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary">
                <i class="ph ph-arrow-left"></i> Voltar
            </a>
        </div>

        <h2 class="mb-4">Editar Tarefa</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('tasks.update', $task->id_task) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Título</label>
                <input type="text" name="title" id="title" class="form-control"
                    value="{{ old('title', $task->title) }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Descrição</label>
                <textarea name="description" id="description" class="form-control" rows="3">{{ old('description', $task->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Categoria</label>
                <select name="category" id="category" class="form-select">
                    <option value="">Selecione uma categoria</option>
                    <option value="Pessoal" {{ old('category', $task->category) == 'Pessoal' ? 'selected' : '' }}>Pessoal
                    </option>
                    <option value="Trabalho" {{ old('category', $task->category) == 'Trabalho' ? 'selected' : '' }}>Trabalho
                    </option>
                    <option value="Estudo" {{ old('category', $task->category) == 'Estudo' ? 'selected' : '' }}>Estudo
                    </option>
                    <option value="Outro" {{ old('category', $task->category) == 'Outro' ? 'selected' : '' }}>Outro
                    </option>
                </select>
            </div>

            <div class="mb-3">
                <label for="priority" class="form-label">Prioridade</label>
                <input type="number" name="priority" id="priority" class="form-control" min="1" max="3"
                    value="{{ old('priority', $task->priority) }}">
            </div>

            <div class="mb-3">
                <label for="due_date" class="form-label">Data Limite</label>
                <input type="date" name="due_date" id="due_date" class="form-control"
                    value="{{ old('due_date', \Carbon\Carbon::parse($task->due_date)->format('Y-m-d')) }}" required>
            </div>

            <div class="mb-3">
                <label for="arquivo" class="form-label">Arquivo (opcional)</label>
                <input type="file" name="arquivo" id="arquivo" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Atualizar Tarefa</button>
            <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection

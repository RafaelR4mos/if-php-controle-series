@extends('layouts.app')

@section('content')
    <div class="custom-container">
        <h2 class="mb-4">Criar Nova Tarefa</h2>

        {{-- Exibir erros de validação --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('tasks.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Título</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Descrição</label>
                <textarea name="description" id="description" class="form-control" rows="3">{{ old('description') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Categoria</label>
                <select name="category" id="category" class="form-select">
                    <option value="">Selecione uma categoria</option>
                    <option value="Pessoal" {{ old('category') == 'Pessoal' ? 'selected' : '' }}>Pessoal</option>
                    <option value="Trabalho" {{ old('category') == 'Trabalho' ? 'selected' : '' }}>Trabalho</option>
                    <option value="Estudos" {{ old('category') == 'Estudos' ? 'selected' : '' }}>Estudos</option>
                    <option value="Outro" {{ old('category') == 'Outro' ? 'selected' : '' }}>Outro</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="priority" class="form-label">Prioridade</label>
                <input type="number" name="priority" id="priority" class="form-control" min="1" max="3"
                    value="{{ old('priority', 1) }}">
            </div>

            <div class="mb-3">
                <label for="due_date" class="form-label">Data Limite</label>
                <input type="date" name="due_date" id="due_date" class="form-control" value="{{ old('due_date') }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="arquivo" class="form-label">Arquivo (opcional)</label>
                <input type="file" name="arquivo" id="arquivo" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Criar Tarefa</button>
            <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection

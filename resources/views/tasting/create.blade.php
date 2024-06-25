@extends('components.base')

@section('title', 'Nova degustação')

@section('content')
    <h1 class="titulo__header">Cadastrar nova degustação</h1>

    @if(session('error'))
        <p class="ingrediente__error">{{ session('error') }}</p>
    @endif

    @if(Auth::user()->employee)
        <form action="{{ route('tasting.store') }}" method="POST" class="formulario">
            @csrf

            <input type="hidden" name="employee_id" value="{{ Auth::user()->employee->id }}">
            <input type="hidden" name="date" value="{{ date('Y-m-d') }}">

            <label for="recipe_id">Receita</label>
            <select name="recipe_id" id="recipe_id" class="form-control">
                @foreach ($recipes as $recipe)
                    <option value="{{ $recipe->id }}">{{ $recipe->name }}</option>
                @endforeach
            </select>

            <label for="rating">Nota</label>
            <input type="number" name="rating" id="rating" min="0" max="5" class="form-control">

            <button type="submit" class="salvar">Salvar</button>

        </form>
    @else
        <p>Você não possui um perfil de funcionário e não pode cadastrar degustações</p>
    @endif

@endsection

@section('style')
<style>
    .titulo__header {
        color: #FF9E0B;
        font-size: 36px;
        font-weight: 500;
        letter-spacing: normal;
        line-height: 120%;
        padding: 20px 0px 20px 50px;
    }

    .ingrediente__error {
        color: #b94520;
        padding: 0 50px;
    }

    .formulario {
        background-color: #fff;
        border-radius: 4px;
        color: rgba(0, 0, 0, 0.6);
        font-size: 16px;
        font-weight: 400;
        line-height: 48px;
        padding: 20px 0px 20px 50px;
        transition: border 0.2s ease-in-out;
        width: 100%;
    }

    .formulario input,
    .formulario select {
        display: block;
        color: rgba(0, 0, 0, 0.4);
        font-weight: 400;
        padding-bottom: 5px;
        border-radius: 4px;
        width: 50%;
        margin-bottom: 15px;
        border: 1px solid rgba(234, 195, 157, 0.5);
    }

    .formulario select {
        width: 50%;
        padding: 8px;
    }

    .salvar {
        background-color: #FBF7ED;
        border: 1px solid #FF9E0B;
        border-radius: 8px;
        color: #FF9E0B;
        font-size: 14px;
        padding: 3px 30px;
        display: inline-block;
    }

    .salvar:hover {
        background-color: #FF9E0B;
        color: #FBF7ED;
    }

    ::placeholder {
        color: rgba(0, 0, 0, 0.4);
        font-weight: 400;
        padding-bottom: 5px;
    }
</style>
@endsection

@section('script')
@endsection

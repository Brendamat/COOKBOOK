@extends('components.base')

@section('title', 'Degustações')

@section('content')
    <h1 class="titulo__header">Degustações</h1>

    <div>
        <form action="{{ route('tasting.index') }}" class="form-filtrar">
            <i class="ri-search-line"></i>
            <input type="text" name="filter" placeholder="Filtrar degustações" class="input-filtrar">
        </form>

        @if (Auth::user()->employee && (Auth::user()->role->name == 'taster' || Auth::user()->role->name == 'admin'))
            <a href="{{ route('tasting.create') }}" class="btn btn-primary salvar">Nova degustação</a>
        @endif
    </div>

    <ul class="lista-degustacoes">
        @foreach ($tastings as $tasting)
            <li class="item-degustacao">
                <a href="{{ route('recipe.show', $tasting->recipe->id) }}" class="nome-receita">{{ $tasting->recipe->name }}</a>
                - {{ $tasting->rating }} - {{ $tasting->employee->user->name }}
                @if ($tasting->employee->user->id == Auth::user()->id)
                    - <a href="{{ route('tasting.edit', $tasting->id) }}" class="acao-editar">Editar</a>
                    - <a href="{{ route('tasting.delete', $tasting->id) }}" class="acao-apagar">Apagar</a>
                @endif
            </li>
        @endforeach
    </ul>
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

    .form-filtrar {
        padding-left: 30px; /* Adicionando um espaçamento à esquerda para o formulário de filtro */
        margin-bottom: 20px; /* Espaçamento inferior para separar os itens */
    }

    .input-filtrar {
        width: 300px; /* Definindo uma largura para o input de filtro */
        padding: 8px; /* Adicionando um padding interno para o input */
        border: 1px solid #ccc; /* Adicionando uma borda */
        border-radius: 4px; /* Arredondando as bordas */
        font-size: 14px; /* Tamanho da fonte */
    }

    .lista-degustacoes {
        list-style: none;
        padding-left: 0;
    }

    .item-degustacao {
        margin-bottom: 15px;
        padding: 10px 50px;
        background-color: #fff;
        border-radius: 4px;
        border: 1px solid rgba(234, 195, 157, 0.5);
    }

    .nome-receita {
        color: #FF9E0B;
        font-weight: bold;
        text-decoration: none;
        margin-right: 10px;
    }

    .acao-editar,
    .acao-apagar {
        color: #FF9E0B;
        text-decoration: none;
        margin-left: 10px;
    }

    .btn {
        background-color: #FBF7ED;
        border: 1px solid #FF9E0B;
        border-radius: 8px;
        color: #FF9E0B;
        font-size: 14px;
        padding: 3px 30px;
        display: inline-block;
        text-decoration: none;
        margin-top: 10px;
    }

    .btn:hover {
        background-color: #FF9E0B;
        color: #FBF7ED;
    }

    .btn-primary {
        background-color: #FF9E0B;
        border-color: #FF9E0B;
        color: #FBF7ED;
        margin: 0px 50px 30px;
        padding: 10px;
        width: 29%;
    }

    .btn-primary:hover {
        background-color: #FBF7ED;
        color: #FF9E0B;
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

    .formulario input {
        display: block;
        color: rgba(0, 0, 0, 0.4);
        font-weight: 400;
        padding-bottom: 5px;
        border-radius: 4px;
        width: 50%;
        margin-bottom: 15px;
        border: 1px solid rgba(234, 195, 157, 0.5);
    }

    ::placeholder {
        color: rgba(0, 0, 0, 0.4);
        font-weight: 400;
        padding-bottom: 5px;
    }

    .ri-search-line {
        position: relative;
        left: 280px;
        color: rgba(0, 0, 0, 0.4);
    }
</style>
@endsection

@section('script')
<script>
</script>
@endsection

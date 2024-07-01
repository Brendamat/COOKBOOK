@extends('components.base')

@section('title', 'Home')

@section('content')
    <h1>Categorias</h1>

    @if(session('error'))
        <p>{{session('error')}}</p>
    @endif
    <div class="formulario-foreach">
        @foreach ($categories as $category)
            <div class="listagem">
                <h3>{{ $category->name }}</h3>

                <div class="d-flex align-items-center">
                    <form action="{{route('category.update')}}" method="POST" class="form-inline">
                        @csrf
                        <input type="hidden" name="id" value="{{$category->id}}">
                        <input type="text" name="name" placeholder="Atualizar nome da categoria">
                        <button type="submit" class="salvar">Atualizar</button>
                    </form>

                    <form action="{{route('category.delete')}}" method="POST" class="form-inline">
                        @csrf
                        <input type="hidden" name="id" value="{{$category->id}}">
                        <button type="submit" class="deletar">Deletar</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
    <h1>Cadastrar categoria</h1>

    <form action="{{route('category.store')}}" method="POST" class="formulario">
        @csrf
        <input type="text" name="name" placeholder="Nome da categoria">
        <button type="submit" class="salvar">Criar</button>
    </form>
@endsection

@section('style')
<style>
    main {
        background-color: #FBF7ED;
        height: 100vh;
    }

    .salvar, .deletar {
        background-color: #FBF7ED;
        border: 1px solid #FF9E0B;
        border-radius: 8px;
        color: #FF9E0B;
        font-size: 14px;
        padding: 12px 18px;
        margin-left: 10px; /* Espaçamento entre os botões */
    }

    .salvar { margin-left: 0; }

    .deletar {
        background-color: #fbeded;
        border: 1px solid #a2363b;
        color: #e41313;
        padding: 12px 16px;
    }

    .box-categorias {
        padding: 120px 100px;
    }

    .box-categoriasWrapper {
        background-color: #fff;
        border: 1px solid #FF9E0B;
        padding: 30px;
        border-radius: 16px;
    }

    .box-categoriasWrapper h1 {
        font-size: 28px;
        color: #8E3F1A;
    }

    .box-categoriasWrapper table {
        width: 100%;
    }

    .box-categoriasWrapper thead {
        background-color: #FF9E0B;
    }

    .box-categoriasWrapper th {
        padding: 8px;
        color: #FBF7ED;
    }

    .box-categoriasWrapper td {
        padding: 10px;
        border-bottom: 1px solid #FF9E0B;
    }

    .formulario-foreach {
        display: grid;
        grid-template-columns: 1fr 1fr;
    }

    .form-inline > input {
        background-color: #fff;
        border-radius: 4px;
        height: 48px;
        transition: border .2s ease-in-out;
        width: 200px;
        color: rgba(0, 0, 0, .4);
        font-weight: 400;
        border: 1px solid rgba(234, 195, 157, .5);
        font-size: 15px;
        margin-right: 10px;
    }

    .formulario {
        display: flex;
        flex-direction: column;
        padding: 20px;
        gap: 20px;
    }

    .formulario > input {
        padding: 10px;
        border: 1px solid rgba(234, 195, 157, .5);
        border-radius: 4px;
    }

    h1 {
        color: #FF9E0B;
        font-size: 36px;
        font-weight: 500;
        letter-spacing: normal;
        line-height: 120%;
        padding: 20px 0px 20px 20px;
    }

    h3 {
        font-size: 1.3rem;
        display: inline-block; /* Mantém o título na mesma linha */
        padding: 0 14px;
    }

    .listagem {
        margin-bottom: 50px;
    }

    .d-flex {
        display: flex;
    }

    .align-items-center {
        align-items: center;
    }

    .form-inline {
        display: flex;
        align-items: center;
        margin-left: 10px;
    }
</style>
@endsection

@section('script')
<script>
</script>
@endsection

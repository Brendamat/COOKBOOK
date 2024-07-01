@extends('components.base')

@section('title', 'Perfil')

@section('content')
    <div>
        <h1 class="editar_usuario__header">Informações gerais do perfil</h1>
        <p class="title"><strong class="title__strong">Nome:</strong> {{ $user->name }}</p>
        <p class="title"><strong class="title__strong">Email:</strong> {{ $user->email }}</p>
        <p class="title"><strong class="title__strong">ID do usuário:</strong> {{ $user->id }}</p>
        <p class="title"><strong class="title__strong">Perfil criado em:</strong> {{ $user->created_at }}</p>
        <p class="title"><strong class="title__strong">Perfil atualizado em:</strong> {{ $user->updated_at }}</p>
        <div class="form__buttons">
            <a href="{{ route('user.edit', $user->id) }}" class="salvar">Editar</a>
            <a href="{{ route('user.index') }}" class="voltar">Voltar</a>
        </div>
    </div>
@endsection

@section('script')
<script>
    console.log('Hello World');
</script>
@endsection

@section('style')
<style>
    main {
        background-color: #FBF7ED;
        height: 100vh;
    }

    .editar_usuario__header {
        color: #FF9E0B;
        font-size: 36px;
        font-weight: 500;
        letter-spacing: normal;
        line-height: 120%;
        padding: 60px 0px 20px 30px;
    }

    .title {
        letter-spacing: normal;
        line-height: 120%;
    }

    .title__strong {
        color: #8E3F1A;
        padding: 0 0 0 30px;
    }

    .form__buttons {
        display: flex;
        gap: 40px;
        margin: 20px 3%;
    }

    .form__buttons button,
    .form__buttons a {
        width: 25%;
        text-align: center;
    }

    .salvar,
    .voltar {
        background-color: #FBF7ED;
        border: 1px solid #FF9E0B;
        border-radius: 8px;
        color: #FF9E0B;
        font-size: 14px;
        padding: 8px 16px;
    }

    .voltar {
        padding: 10px 16px;
    }
</style>
@endsection


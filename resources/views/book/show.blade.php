@extends('components.base')

@section('title', 'Detalhes do livro')

@section('content')
<section class="box-book_detail">
    <div class="box-bookWrapper">
        <h1>Detalhes do livro</h1>

        @if(session('error'))
            <p>{{session('error')}}</p>
        @endif

        @if(session('success'))
            <p>{{session('success')}}</p>
        @endif

        <div class="book-detail-header">
            <h1>{{$book->name}}
                @if(!$book->published_at)
                    <span class="badge bg-danger">Não publicado</span>
                @endif
            </h1>
            <p>Publicado por {{$book->employee->user->name}}</p>
        </div>

        <h2>Receitas</h2>
        <ul>
            @foreach ($book->publications as $publication)
                <li>
                    <a href="{{route('recipe.show', $publication->recipe_id)}}" class="recipeLink">
                        <div class="d-flex flex-column recipeLink">
                            {{$publication->recipe->name}}
                            <img src="{{ asset('storage/recipe_images/'.$publication->recipe->photos[0]->name) }}" alt="Imagem da receita">
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>

        <div class="book-actions">
            @if($book->published_at)
                <h2>Publicado em:</h2>
                <p>{{ \Carbon\Carbon::parse($book->published_at)->format('d/m/Y') }}</p>
            @elseif($book->employee->id == Auth::user()->employee->id)
                <a href="{{route('book.publish', $book->id)}}" class="btn btn-success">Publicar</a>
                <a href="{{route('book.edit', $book->id)}}" class="btn btn-primary">Editar</a>
                <a href="{{route('book.delete', $book->id)}}" class="btn btn-danger">Excluir</a>
            @endif
            <a class="btn btn-primary" onclick="window.print()">Gerar PDF</a>
        </div>
    </div>
</section>
@endsection

@section('style')
<style>
    main {
        background-color: #FBF7ED;
        height: 100vh;
    }

    .box-book_detail {
        padding: 120px 100px;
    }

    .box-bookWrapper {
        background-color: #fff;
        border: 1px solid #FF9E0B;
        padding: 30px;
        border-radius: 16px;
    }

    h1, h2 {
        color: #FF9E0B;
        font-size: 36px;
        font-weight: 500;
        margin-bottom: 20px;
    }

    h2 {
        font-size: 24px;
    }

    .book-detail-header {
        margin-bottom: 20px;
    }

    .recipeLink {
        text-decoration: none;
        color: black;
        display: flex;
        align-items: center;
        transition: all 0.3s;
    }

    .recipeLink:hover {
        transform: scale(1.03);
    }

    .recipeLink img {
        width: 100px;
        height: 100px;
        border-radius: 8px;
        margin-top: 10px;
    }

    .book-actions {
        margin-top: 20px;
    }

    .btn {
        background-color: #FBF7ED;
        border: 1px solid #FF9E0B;
        border-radius: 8px;
        color: #FF9E0B;
        font-size: 14px;
        padding: 12px 18px;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.3s ease-in-out;
        display: inline-block;
        margin-right: 10px;
    }

    .btn:hover {
        background-color: #FF9E0B;
        color: #FBF7ED;
    }

    .btn-success {
        background-color: #FBF7ED;
        border: 1px solid #FF9E0B;
        border-radius: 8px;
        color: #FF9E0B;
        font-size: 14px;
    }

    .btn-primary {
        background-color: #edf3fb;
        border: 1px solid #300bff;
        border-radius: 8px;
        color: #4571b1;
        font-size: 14px;
    }

    .btn-danger {
        background-color: #fbeded;
        border: 1px solid #a2363b;
        border-radius: 8px;
        color: #e41313;
        font-size: 14px;
        padding: 10px 16px;
    }
</style>
@endsection

@section('script')
<script>
</script>
@endsection

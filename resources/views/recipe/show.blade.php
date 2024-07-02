@extends('components.base')

@section('title', 'Detalhes da receita')

@section('content')
<section class="box-recipe_details">
    <div class="box-recipeWrapper">
        <h1>Detalhes da receita</h1>

        <h2 class="recipe-title">
            {{$recipe->name}}
            @if(!$recipe->published)
                <span class="badge bg-success">inédita</span>
            @endif
        </h2>

        <div class="recipe-image">
            <img src="{{ asset('storage/recipe_images/'.$recipe->photos[0]->name) }}" alt="Imagem da receita">
        </div>

        <p>Criada por {{$recipe->employee->user->name}}</p>

        <h2>Ingredientes</h2>
        <ul class="ingredient-list">
            @foreach ($recipe->ingredientRecipes as $pivot)
                <li>{{$pivot->ingredient->name}}: {{$pivot->quantity}}{{$pivot->measure->name}}</li>
            @endforeach
        </ul>

        <h2>Modo de preparo</h2>
        <p>{{$recipe->description}}</p>

        @if($recipe->published)
            <h2>Publicada nos livros:</h2>
            @foreach($recipe->publications as $publication)
                <a href="{{route('book.show', $publication->book_id)}}" class="publication-link">{{$publication->book->title}}</a>
                <a class="btn btn-primary" onclick="window.print()">Gerar PDF</a>
            @endforeach
        @elseif($recipe->employee->id == Auth::user()->employee->id)
            <div class="action-buttons">
                <a class="btn btn-primary" href="{{route('recipe.edit', $recipe->id)}}">Editar receita</a>
                <a class="btn btn-danger" href="{{route('recipe.delete', $recipe->id)}}">Apagar receita</a>
                <a class="btn btn-primary" onclick="window.print()">Gerar PDF</a>
            </div>
        @endif

        @isset($rating)
            <h2>Avaliação média</h2>
            <p>{{$rating}}</p>
        @endisset
    </div>
</section>
@endsection

@section('style')
<style>
    main {
        background-color: #FBF7ED;
        height: 100vh;
    }

    .box-recipe_details {
        padding: 120px 100px;
    }

    .box-recipeWrapper {
        background-color: #fff;
        border: 1px solid #FF9E0B;
        padding: 30px;
        border-radius: 16px;
    }

    h1, h2 {
        color: #FF9E0B;
        font-weight: 500;
        margin-bottom: 20px;
    }

    .recipe-title {
        font-size: 36px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .recipe-image img {
        width: 100%;
        height: auto;
        border-radius: 8px;
        margin-bottom: 20px;
    }

    p {
        font-size: 18px;
        color: #333;
        margin-bottom: 20px;
    }

    .ingredient-list {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }

    .ingredient-list li {
        font-size: 16px;
        color: #555;
        padding: 5px 0;
        border-bottom: 1px solid #FF9E0B;
    }

    .publication-link {
        display: inline-block;
        margin-right: 10px;
        color: #FF9E0B;
        text-decoration: none;
        transition: color 0.3s;
    }

    .publication-link:hover {
        color: #333;
    }

    .action-buttons {
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

    .btn-danger {
        background-color: #fbeded;
        border: 1px solid #a2363b;
        color: #e41313;
    }

    .btn-danger:hover {
        background-color: #e41313;
        color: #FBF7ED;
    }

    @media print{
        .btn{
            display: none;
        }
    }
</style>
@endsection

@section('script')
<script>
</script>
@endsection

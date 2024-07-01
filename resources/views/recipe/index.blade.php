@extends('components.base')

@section('title', 'Receitas')

@section('content')
<section class="box-recipe_index">
    <div class="box-recipeWrapper">
        <div class="box-recipeTitle">
            <h1>Receitas</h1>

            @can('manageRecipes', Auth::user())
                <a href="{{route('recipe.create')}}" class="button">Criar nova receita</a>
            @endcan
        </div>
        @if(session('error'))
            <p class="text-danger">{{session('error')}}</p>
        @endif

        @if(session('success'))
            <p class="text-success">{{session('success')}}</p>
        @endif

        <div class="box-card">
            @foreach ($recipes as $recipe)

                <a href="{{route('recipe.show', $recipe->id)}}" class="recipe-card">

                    <div class="card">

                        <div class="card-headers"
                            style="background-image: url('{{ asset('storage/recipe_images/' . $recipe->photos[0]->name) }}');">
                        </div>



                        <div class="card-body">
                            <h3>{{$recipe->name}}</h3>
                            <p>Criada por: {{$recipe->employee->user->name}}</p>
                            <p>Status:
                                <span
                                    class="badge
                                                                                                {{$recipe->published ? 'text-bg-warning' : 'text-bg-success'}}">
                                    {{$recipe->published ? 'Publicada' : 'Inédita'}}
                                </span>
                            </p>

                        </div>
                    </div>

                </a>

            @endforeach
        </div>


    </div>
</section>
@endsection

@section('style')
<style>
    main {
        background-color: #FBF7ED;
        height: 100vh;
        text-decoration: none;
    }

    .button {
        height: 50px;
        background-color: #FBF7ED;
        border: 1px solid #FF9E0B;
        border-radius: 8px;
        color: #FF9E0B;
        font-size: 14px;
        padding: 12px 18px;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.3s ease-in-out;
        margin: 20px 40px;
    }

    .button:hover {
        background-color: #FF9E0B;
        color: #FBF7ED;
    }

    .box-recipe_index {
        padding: 70px 90px;
    }

    .box-recipeWrapper {
        background-color: #fff;
        border: 1px solid #FF9E0B;
        padding: 30px;
        border-radius: 16px;
    }

    .box-recipeTitle {
        display: flex;
        justify-content: space-between;
        /* margin-bottom: 100px; */
    }

    .box-card {
        display: flex;
        flex-wrap: wrap;
        gap: 50px;
        margin-top: 70px;
    }

    h1 {
        color: #FF9E0B;
        font-size: 36px;
        font-weight: 500;
        letter-spacing: normal;
        line-height: 120%;
        padding: 20px 0px 20px 0px;
    }

    h3 {
        font-size: 1.3rem;
        display: inline-block;
        /* Mantém o título na mesma linha */
        margin-right: 10px;
    }

    .card {
        display: flex;
        border: 1px solid #FF9E0B;
        border-radius: 16px;
        /* overflow: hidden; */
        background-color: #fff;
        width: 200px;
        height: 330px;
        margin-bottom: 60px;
        transition: all 0.3s ease-in-out;
        background-color: #FBF7ED;
    }

    .card:hover {
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        transform: scale(1.03);
    }

    .card-headers {
        border-radius: 150px;
        background-size: cover;
        background-position: center;
        height: 150px;
        width: 150px;
        border: 1px solid #FF9E0B;
        margin-top: -50px;
        margin-left: 25px;
    }

    .card-body {
        padding: 20px;
    }

    .card-body h3 {
        font-size: 20px;
        color: #FF9E0B;
        margin-bottom: 10px;
    }

    .card-body p {
        margin: 5px 0;
        color: #8E3F1A;
    }

    .badge {
        font-size: 12px;
        padding: 5px 10px;
        border-radius: 4px;
    }

    .text-bg-warning {
        background-color: #FFD700;
        color: #fff;
    }

    .text-bg-success {
        background-color: #28a745;
        color: #fff;
    }

    .text-danger {
        font-size: 14px;
        color: #e41313;
    }
</style>
@endsection

@section('script')
<script>
</script>
@endsection
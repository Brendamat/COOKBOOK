@extends('components.base')

@section('title', 'Editar receita')

@section('content')
<section class="box-recipe_edit">
    <div class="box-recipeWrapper">
        <h1>Editar receita</h1>

        @if(session('error'))
            <p>{{session('error')}}</p>
        @endif

        @if(session('success'))
            <p>{{session('success')}}</p>
        @endif

        @if(isset(Auth::user()->employee->id))
        <form action="{{route('recipe.update')}}" method="post" enctype="multipart/form-data">
            @csrf
            @METHOD('patch')

            <input type="hidden" name="recipe_id" value="{{$recipe->id}}">

            <div class="form-group">
                <label for="name">Nome da receita</label>
                <input type="text" name="name" id="name" class="form-control" value="{{$recipe->name}}" required>
            </div>

            <div class="form-group">
                <label for="image">Foto</label>
                <input class="form-control" type="file" name="image" id="image">
            </div>

            <div class="form-group">
                <label for="portions">Porções</label>
                <input type="number" step="0.1" name="portions" id="portions" class="form-control" value="{{$recipe->portions}}" required>
            </div>

            <div class="form-group">
                <label for="category_id">Categoria</label>
                <select name="category_id" id="category_id" class="form-control" required>
                    @foreach ($categories as $category)
                        <option value="{{$category->id}}"
                            {{$category->id == $recipe->category_id ? 'selected' : ''}}
                            >{{$category->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group" id="ingredients">
                <label for="ingredients">Ingredientes</label>
                @foreach ($recipe->ingredientRecipes as $pivot)
                    <div class="d-flex flex-row align-items-center ingredient-row">
                        <select class="form-control" name="ingredient_ids[]" required>
                            @foreach ($ingredients as $ingredient)
                                <option value="{{$ingredient->id}}"
                                    {{$ingredient->id == $pivot->ingredient_id ? 'selected' : ''}}
                                    >{{$ingredient->name}}</option>
                            @endforeach
                        </select>

                        <input type="number" step="0.1" name="quantities[]" class="form-control" value="{{$pivot->quantity}}" required>

                        <select name="measure_ids[]" class="form-control">
                            @foreach ($measures as $measure)
                                <option value="{{$measure->id}}"
                                    {{$measure->id == $pivot->measure_id ? 'selected' : ''}}
                                    >{{$measure->name}}</option>
                            @endforeach
                        </select>

                        <button type="button" class="btn btn-danger remove_ingredient">Remover</button>
                    </div>
                @endforeach

                <button type="button" id="addIngredient" class="btn btn-secondary mt-2">Adicionar ingrediente</button>

                <template>
                    <div class="d-flex flex-row align-items-center ingredient-row">
                        <select class="form-control" name="ingredient_ids[]" required>
                            @foreach ($ingredients as $ingredient)
                                <option value="{{$ingredient->id}}">{{$ingredient->name}}</option>
                            @endforeach
                        </select>

                        <input type="number" step="0.1" name="quantities[]" class="form-control" required>

                        <select name="measure_ids[]" class="form-control">
                            @foreach ($measures as $measure)
                                <option value="{{$measure->id}}">{{$measure->name}}</option>
                            @endforeach
                        </select>

                        <button type="button" class="btn btn-danger remove_ingredient">Remover</button>
                    </div>
                </template>
            </div>

            <div class="form-group">
                <label for="description">Modo de preparo</label>
                <textarea name="description" id="description" class="form-control" required>{{$recipe->description}}</textarea>
            </div>

            <input class="btn btn-success mt-4" type="submit" value="Editar">
        </form>
        @else
            <h1 class="text-danger">Você não possui perfil de funcionário, portanto não pode editar receitas.</h1>
        @endif
    </div>
</section>
@endsection

@section('style')
<style>
    main {
        background-color: #FBF7ED;
        height: 100vh;
    }

    .box-recipe_edit {
        padding: 120px 100px;
    }

    .box-recipeWrapper {
        background-color: #fff;
        border: 1px solid #FF9E0B;
        padding: 30px;
        border-radius: 16px;
    }

    h1 {
        color: #FF9E0B;
        font-size: 36px;
        font-weight: 500;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        font-size: 16px;
        color: #333;
        margin-bottom: 5px;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 16px;
        color: #333;
    }

    .ingredient-row {
        margin-bottom: 10px;
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

    .btn-secondary {
        background-color: #FBF7ED;
        border: 1px solid #FF9E0B;
        color: #FF9E0B;
    }

    .btn-secondary:hover {
        background-color: #ccc;
        color: #333;
    }
</style>
@endsection

@section('script')
<script>
    $('#addIngredient').click(function() {
        var template = $('template').html();
        $('#ingredients').append(template);

        $('.remove_ingredient').click(function() {
            $(this).parent().remove();
        });
    });

    $('.remove_ingredient').click(function() {
        $(this).parent().remove();
    });
</script>
@endsection

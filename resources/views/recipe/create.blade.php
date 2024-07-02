@extends('components.base')

@section('title', 'Cadastrar receita')

@section('content')
<section class="box-recipe_create">
    <div class="box-recipeWrapper">
        <h1>Cadastrar receita</h1>

        @if(session('error'))
            <p>{{session('error')}}</p>
        @endif

        @if(session('success'))
            <p>{{session('success')}}</p>
        @endif

        @if(isset(Auth::user()->employee->id))
            <form action="{{route('recipe.store')}}" method="post" enctype="multipart/form-data" class="form-recipe">
                @csrf

                <input type="hidden" name="employee_id" value="{{Auth::user()->employee->id}}">

                <div class="form-group">
                    <label for="name">Nome da receita</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="image">Foto</label>
                    <input class="form-control" type="file" name="image" id="image">
                </div>

                <div class="form-group">
                    <label for="portions">Porções</label>
                    <input type="number" step="0.1" name="portions" id="portions" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="category_id">Categoria</label>
                    <select name="category_id" id="category_id" class="form-control" required>
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group" id="ingredients">
                    <label for="ingredients">Ingredientes</label>
                    <button type="button" id="addIngredient" class="btn btn-secondary">Adicionar ingrediente</button>

                    {{-- Módulo de ingrediente --}}
                    <template>
                        <hr>
                        <div class="d-flex flex-row align-items-center mt-2">
                            <select class="form-control" name="ingredient_ids[]" required>
                                @foreach ($ingredients as $ingredient)
                                    <option value="{{$ingredient->id}}">{{$ingredient->name}}</option>
                                @endforeach
                            </select>

                            <input type="number" step="0.1" name="quantities[]" class="form-control mx-2" required>
                            <select name="measure_ids[]" class="form-control" required>
                                @foreach ($measures as $measure)
                                    <option value="{{$measure->id}}">{{$measure->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </template>
                </div>

                <div class="form-group">
                    <label for="description">Modo de preparo</label>
                    <textarea name="description" id="description" class="form-control" required></textarea>
                </div>

                <input class="btn btn-success mt-3" type="submit" value="Cadastrar">
            </form>
        @else
            <h1 class="text-danger">Você não possui perfil de funcionário, portanto não pode cadastrar receitas.</h1>
        @endif
    </div>
</section>
@endsection

@section('style')
<style>
    main {
        background-color: #FBF7ED;
        /* height: 100vh; */
    }

    .box-recipe_create {
        padding: 60px 80px;
    }

    .box-recipeWrapper {
        background-color: #fff;
        border: 1px solid #FF9E0B;
        padding: 30px;
        border-radius: 16px;
    }

    .form-recipe .form-group {
        margin-bottom: 20px;
    }

    .form-recipe .form-control {
        background-color: #fff;
        border: 1px solid rgba(234, 195, 157, .5);
        border-radius: 4px;
        height: 48px;
        color: rgba(0, 0, 0, .6);
        font-size: 16px;
        padding: 0 10px;
        transition: border .2s ease-in-out;
    }

    .form-recipe label {
        color: rgba(0, 0, 0, .4);
        font-weight: 400;
        padding-bottom: 5px;
        display: block;
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
    }

    .btn:hover {
        background-color: #FF9E0B;
        color: #FBF7ED;
    }

    .btn-secondary {
        background-color: #fbeded;
        border: 1px solid #a2363b;
        color: #e41313;
    }

    .d-flex {
        display: flex;
    }

    .align-items-center {
        align-items: center;
    }

    .mt-2 {
        margin-top: 10px;
    }

    .mt-3 {
        margin-top: 20px;
    }

    hr {
        border: 1px solid #FF9E0B;
        width: 100%;
        margin: 20px 0;
    }
    h1 {
        color: #FF9E0B;
        font-size: 36px;
        font-weight: 500;
        letter-spacing: normal;
        line-height: 120%;
    }

    .text-danger {
        font-size: 14px;
        color: #e41313;
    }
</style>
@endsection

@section('script')
<script>
    document.getElementById('addIngredient').addEventListener('click', function () {
        var template = document.querySelector('template').content.cloneNode(true);
        document.getElementById('ingredients').appendChild(template);
    });
</script>
@endsection

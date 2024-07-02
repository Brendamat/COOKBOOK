@extends('components.base')

@section('title', 'Cadastrar livro')

@section('content')
<section class="box-book_create">
    <div class="box-bookWrapper">
        <h1>Cadastrar livro</h1>

        @if(session('error'))
            <p>{{session('error')}}</p>
        @endif

        @if(session('success'))
            <p>{{session('success')}}</p>
        @endif

        @if(isset(Auth::user()->employee->id))
        <form action="{{route('book.store')}}" method="post" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="employee_id" value="{{Auth::user()->employee->id}}" required>

            <div class="form-group">
                <label for="title">Título do livro</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="isbn">Código ISBN</label>
                <input type="number" name="isbn" id="isbn" class="form-control" required>
            </div>

            <div class="form-group" id="recipes">
                <label for="recipes">Receitas</label>
                <button type="button" id="addRecipe" class="btn btn-secondary">Adicionar receita</button>

                {{-- Módulo de receita --}}
                <template>
                    <hr>
                    <div class="d-flex flex-row">
                        <select class="form-control" name="recipe_ids[]" required>
                            @foreach ($recipes as $recipe)
                                <option value="{{$recipe->id}}" required>{{$recipe->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </template>
            </div>

            <input class="btn btn-success" type="submit" value="Cadastrar">
        </form>
        @else
            <h1 class="text-danger">Você não possui perfil de funcionário, portanto não pode cadastrar livros.</h1>
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

    .box-book_create {
        padding: 60px 80px;
    }

    .box-bookWrapper {
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
        font-weight: 500;
        margin-bottom: 8px;
        display: block;
    }

    .form-control {
        border: 1px solid #FF9E0B;
        border-radius: 8px;
        padding: 10px;
        width: 100%;
        box-sizing: border-box;
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
        margin-top: 20px;
    }

    .btn:hover {
        background-color: #FF9E0B;
        color: #FBF7ED;
    }

    .btn-secondary {
        background-color: #FF9E0B;
        color: #FBF7ED;
        border: 1px solid #FF9E0B;
    }

    .btn-secondary:hover {
        background-color: #FBF7ED;
        color: #FF9E0B;
    }

    .text-danger {
        font-size: 14px;
        color: #e41313;
    }
</style>
@endsection

@section('script')
<script>
    $('#addRecipe').click(function() {
        var template = $('template').html();
        $('#recipes').append(template);
    });
</script>
@endsection

@extends('components.base')

@section('title', 'Editar livro')

@section('content')
<section class="box-book_detail">
    <div class="box-bookWrapper">
        <h1>Editar livro</h1>

        @if(session('error'))
            <p>{{session('error')}}</p>
        @endif

        @if(session('success'))
            <p>{{session('success')}}</p>
        @endif

        @if(isset(Auth::user()->employee->id))
        <form action="{{route('book.update')}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <input type="hidden" name="book_id" value="{{$book->id}}" required>

            <div class="form-group">
                <label for="title">Título do livro</label>
                <input type="text" name="title" id="title" class="form-control" value="{{$book->title}}" required>
            </div>

            <div class="form-group">
                <label for="isbn">Código ISBN</label>
                <input type="number" name="isbn" id="isbn" class="form-control" value="{{$book->isbn}}" required>
            </div>

            <div class="form-group" id="recipes">
                <label for="recipes">Receitas</label>

                @foreach ($book->publications as $publication)
                    <div class="d-flex flex-row">

                        <select class="form-control" name="recipe_ids[]" required>
                            @foreach ($recipes as $recipe)
                                <option value="{{$recipe->id}}" {{$recipe->id == $publication->recipe_id ? 'selected' : ''}}>{{$recipe->name}}</option>
                            @endforeach
                        </select>

                        <button type="button" class="btn btn-danger remove_recipe">Remover</button>
                    </div>
                @endforeach

                <button type="button" id="addRecipe" class="btn btn-secondary">Adicionar receita</button>

                {{-- Módulo de receita --}}
                <template>
                    <hr>
                    <div class="d-flex flex-row">

                        <select class="form-control" name="recipe_ids[]" required>
                            @foreach ($recipes as $recipe)
                                <option value="{{$recipe->id}}">{{$recipe->name}}</option>
                            @endforeach
                        </select>

                        <button type="button" class="btn btn-danger remove_recipe">Remover</button>

                    </div>
                </template>

            </div>

            <div class="form-group">
                <label for="will_publish">Deseja publicar o livro?</label>
                <input type="checkbox" name="will_publish" id="will_publish">
            </div>

            <input class="btn btn-success" type="submit" value="Editar">
        </form>
        @else
            <h1 class="text-danger">Você não possui perfil de funcionário, portanto não pode editar livros.</h1>
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

    .box-book_detail {
        padding: 120px 100px;
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
        color: #333;
        font-weight: 500;
    }

    .form-group input,
    .form-group select {
        border: 1px solid #ced4da;
        border-radius: 4px;
        padding: 8px;
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
    }

    .btn:hover {
        background-color: #FF9E0B;
        color: #FBF7ED;
    }

    .btn-success {
        background-color: #edf3fb;
        border: 1px solid #300bff;
        border-radius: 8px;
        color: #4571b1;
        font-size: 14px;
    }

    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
        color: #fff;
    }

    .btn-secondary {
        background-color: #FBF7ED;
        border: 1px solid #FF9E0B;
        border-radius: 8px;
        color: #FF9E0B;
        font-size: 14px;
        margin-top: 10px;
    }

    .d-flex {
        display: flex;
        align-items: center;
    }

    .d-flex .form-control {
        margin-right: 10px;
    }
</style>
@endsection

@section('script')
<script>
    $('#addRecipe').click(function() {
        var template = $('template').html();
        $('#recipes').append(template);

        $('.remove_recipe').click(function() {
            $(this).parent().remove();
        });
    });

    $('.remove_recipe').click(function() {
        $(this).parent().remove();
    });
</script>
@endsection

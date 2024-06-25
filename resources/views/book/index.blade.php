@extends('components.base')

@section('title', 'Livros')

@section('content')
<section class="box-books">
    <div class="box-booksWrapper">
        <div class="box-bookTitle">
            <h1>Livros</h1>

            @can('manageBooks', Auth::user())
                <a href="{{route('book.create')}}" class="btn">Criar novo livro</a>
            @endcan

        </div>
        @if(session('error'))
            <p>{{session('error')}}</p>
        @endif

        @if(session('success'))
            <p>{{session('success')}}</p>
        @endif

        <div class="box-book">
            @foreach ($books as $book)
                <a href="{{route('book.show', $book->id)}}" class="book-card ms-3">
                    <div class="card">
                        <div class="card-headers"
                            style="background-image: url('{{ asset('storage/recipe_images/' . $book->publications[0]->recipe->photos[0]->name) }}');">
                        </div>
                        <div class="card-body">
                            <h3>{{$book->title}}</h3>
                            @if(!$book->published_at)
                                <span class="badge bg-danger">Não publicado</span>
                            @else
                                <p>Compilado por {{$book->employee->user->name}}</p>
                            @endif
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
    }

    .box-books {
        padding: 120px 100px;
    }

    .box-booksWrapper {
        background-color: #fff;
        border: 1px solid #FF9E0B;
        padding: 30px;
        border-radius: 16px;
    }

    .box-bookTitle {
        display: flex;
        justify-content: space-between;
        margin-bottom: 100px;
    }

    .box-book {
        display: flex;
        flex-wrap: wrap;
        gap: 50px;
    }

    h1 {
        color: #FF9E0B;
        font-size: 36px;
        font-weight: 500;
        letter-spacing: normal;
        line-height: 120%;
        padding: 20px 0px 20px 50px;
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

    .btn {
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

    .btn:hover {
        background-color: #FF9E0B;
        color: #FBF7ED;
    }

    .badge {
        display: inline-block;
        padding: 0.5em 0.75em;
        font-size: 75%;
        font-weight: 700;
        line-height: 1;
        color: #fff;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: 0.375rem;
    }

    .bg-danger {
        background-color: #e3342f;
    }

    .bg-success {
        background-color: #38c172;
    }

    .bg-warning {
        background-color: #ffed4a;
    }
</style>
@endsection

@section('script')
<script>
</script>
@endsection
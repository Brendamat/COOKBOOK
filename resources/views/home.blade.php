@extends('components.base')

@section('title', 'Home')

@section('content')
    <div class="box-main">
        <h1 class="box-main__title">Olá, {{ $userName }}</h1>
    </div>

    <div>
        <section class="section-main">
            <div class="section-main__cards">
                <a href="{{route('book.index')}}">
                    <div class="box-cards__infos">
                        <h2 class="box-cards__infosTitle">Livros Cadastrados</h2>
                        <strong class="box-cards__infosStrong">{{ $booksCount }}</strong>
                    </div>
                </a>
            </div>

            <div class="section-main__cards">
                <a href="{{route('recipe.index')}}">
                    <div class="box-cards__infos">
                        <h2 class="box-cards__infosTitle">Receitas Cadastradas</h2>
                        <strong class="box-cards__infosStrong">{{ $recipesCount }}</strong>
                    </div>
                </a>
            </div>

            @if($userRole == 'chef')
                <div class="section-main__cards">
                    <a href="{{route('recipe.index')}}">
                        <div class="box-cards__infos">
                            <h2 class="box-cards__infosTitle">Suas Receitas Cadastradas</h2>
                            <strong class="box-cards__infosStrong">{{ $useRecipesCount }}</strong>
                        </div>
                    </a>
                </div>
            @endif
        </section>

        @if($userRole == 'admin' || $userRole == 'hr')
            <section class="section-users">
                <div class="section-users__cards">
                    <a href="{{ route('user.index') }}">
                        <div class="box-cardsUser__infos">
                            <h3 class="box-cardsUser__infosTitle">Usuários</h3>

                            <div class="list-users">
                                <div>
                                    <p class="list-users__title">ativos - por cargos</p>
                                    <ul>
                                        <li>
                                            <p class="list-users__text">{{ $adminCount }}</p>
                                            <strong class="list-users__strong">admin</strong>
                                        </li>
                                        <li>
                                            <p class="list-users__text">{{ $userCount }}</p>
                                            <strong class="list-users__strong">usuários</strong>
                                        </li>
                                        <li>
                                            <p class="list-users__text">{{ $chefCount }}</p>
                                            <strong class="list-users__strong">chef</strong>
                                        </li>
                                        <li>
                                            <p class="list-users__text">{{ $hrCount }}</p>
                                            <strong class="list-users__strong">rh</strong>
                                        </li>
                                        <li>
                                            <p class="list-users__text">{{ $tasterCount }}</p>
                                            <strong class="list-users__strong">degustador</strong>
                                        </li>
                                        <li>
                                            <p class="list-users__text">{{ $publisherCount }}</p>
                                            <strong class="list-users__strong">publicador</strong>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </section>
        @endif

        @if($userRole == 'user' || $userRole == 'hr' || $userRole == 'taster' || $userRole == 'publisher')
            <section class="section-users" style="padding-bottom: 30px;">
                <div class="section-users__cards">
                    <a href="">
                        <div class="box-cardsUser__infos">
                            <h3 class="box-cardsUser__infosTitle">Degustações</h3>

                            <div class="list-users">
                                <div>
                                    <ul>
                                        <!-- <li>
                                            <p class="list-users__text">{{ $recentTastings }}</p>
                                            <strong class="list-users__strong">ultimas degustações</strong>
                                        </li> -->
                                        <li>
                                            <p class="list-users__text">{{ $tastingsCount }}</p>
                                            <strong class="list-users__strong">todas degustações</strong>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </section>
        @endif
    </div>

@endsection

@section('style')
<style>
    main {
        padding: 15px 20px;
        background-color: #FBF7ED;
        height: 100vh;
    }

    a { text-decoration: none;}

    .box-main {
        display: flex;
        align-items: center;
        margin-top: 21px;
        padding-bottom: 15px;
        width: 100%;
    }

    .box-main__title {
        color: #8E3F1A;
        font-size: 36px;
        font-weight: 500;
        line-height: 120%;
    }

    .section-main {
        display: flex;
        flex-wrap: wrap;
    }

    .section-main__cards {
        width: 50%;
        margin-top: 5px;
        padding: 10px;
    }
    .box-cards__infos {
        display: flex;
        align-items: center;
        flex-direction: row;
        justify-content: space-between;
        background-color: #fff;
        border-radius: 12px;
        border: 1px solid #8E3F1A;
        height: 130px;
        padding: 12px;
    }

    .box-cards__infosTitle {
        font-size: 16px;
        font-weight: 600;
        color: #000;
    }

    .box-cards__infosStrong {
        font-size: 36px;
        font-weight: 600;
        line-height: 57.6px;
        color: #FF9E0B;
    }

    .section-users {
        display: flex;
        flex-wrap: wrap;
    }

    .section-users__cards {
        margin-top: 50px;
        padding: 10px;
        width: 100%;
    }

    .box-cardsUser__infos {
        background-color: #fff;
        border: 1px solid #8E3F1A;
        border-radius: 12px;
        height: 100%;
    }

    .box-cardsUser__infosTitle {
        border-bottom: 1px solid #8E3F1A;
        margin-bottom: 14px;
        padding: 14px 14px 10px;
        color: #000;
        font-size: 18px;
        font-weight: 500;
        line-height: 27px;
    }

    .list-users__title {
        font-size: 16px;
        font-weight: 500;
        padding: 16px 0 0 14px;
        color: #8E3F1A;
    }

    .list-users ul {
        display: flex;
        justify-content: space-around;
        padding: 10px 10px 25px;
        text-align: center;
        list-style: none;
    }

    .list-users__strong {
        color: #000;
        font-size: 14px;
        font-weight: 400;
        line-height: 16.8px;
    }

    .list-users__text {
        color: #FF9E0B;
        font-size: 24px;
        font-weight: 400;
        line-height: 28.8px;
    }
</style>
@endsection

@section('script')
<script>
    console.log('Home');
</script>
@endsection

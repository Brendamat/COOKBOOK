@extends('components.base')

@section('title', 'Perfil')

@section('content')
    <h1 class="perfil__header">Editar Perfil</h1>

    @if(session('error'))
        <p class="msg_error">{{ session('error') }}</p>
    @endif

    @if(session('success'))
        <p class="msg_success">{{ session('success') }}</p>
    @endif

    <div style="padding: 20px;">
        <div class="perfil__container">
            <aside class="nome__col">
                <h2 class="perfil__title">{{$user->name}}</h2>
            </aside>

            <form method="POST" action="{{ route('profile.update', $user->id) }}" class="profile-form">
            @csrf

            <input type="hidden" name="id" value="{{$user->id}}">

            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" name="email" id="email" value="{{ $user->email }}">
            </div>

            <div class="form-group">
                <label for="oldPassword">Senha Antiga</label>
                <input type="password" name="oldPassword" id="oldPassword">
            </div>

            <div class="form-group">
                <label for="password">Nova Senha</label>
                <input type="password" name="password" id="password">
            </div>

            <div class="form-group">
                <label for="password_confirmation">Repita a nova senha</label>
                <input type="password" name="password_confirmation" id="password_confirmation">
            </div>

            <button class="salvar" type="submit">Salvar</button>
            </form>
        </div>

        @if($user->role->name == 'chef')

            <div class="experiencia__container">
                <div>
                    <h1 class="perfil__title">Experiência</h1>
                    <div class="perfil__experiencia">
                        @foreach ($user->employee->experiences as $experience)
                            <div class="experiencia__item">
                                <p><strong>Restaurante:</strong> {{$experience->restaurant->name}}</p>
                                <p>{{App\Helpers\GlobalHelper::convertDate($experience->start_date)}} -
                                    {{$experience->end_date ? App\Helpers\GlobalHelper::convertDate($experience->end_date) : 'Atual'}}
                                </p>
                                <form method="POST" action="{{ route('employee.removeExperience') }}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$experience->id}}">
                                    <input type="hidden" name="restaurant" value="{{$experience->restaurant->id}}">
                                    <button type="submit" class="btn-remover">Remover</button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>

                <h1 class="perfil__title">Adicionar Experiência</h1>
                <form method="POST" action="{{ route('employee.addExperience') }}" class="add-experience-form">
                    @csrf
                    <input type="hidden" name="employee_id" value="{{$user->employee->id}}">

                    <div class="form-group">
                        <label for="restaurant_id">Restaurante</label>
                        <select name="restaurant_id" id="restaurant_id" class="form-control">
                            @foreach ($restaurants as $restaurant)
                                <option value="{{$restaurant->id}}">{{$restaurant->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="start_date">Data de admissão</label>
                        <input type="date" name="start_date" id="start_date" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="end_date">Data de demissão</label>
                        <input type="date" name="end_date" id="end_date" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="current_job">Emprego atual</label>
                        <input type="checkbox" name="current_job" id="current_job">
                    </div>

                    <button type="submit" class="salvar">Adicionar</button>
                </form>
            </div>
        @endif
    </div>
@endsection

@section('style')
<style>
    main {
        background-color: #FBF7ED;
        height: 95%;
    }
    .perfil__header{
        color: #FF9E0B;
        font-size: 36px;
        font-weight: 500;
        letter-spacing: normal;
        line-height: 120%;
        padding: 20px 0px 20px 40px;
    }
    .msg_success {
        padding: 0px 0px 0px 40px;
        color: #7db920;
    }
    .msg_error {
        padding: 0px 0px 0px 40px;
        color: #b94520;
    }
    .perfil__title {
        font-size: 24px;
        margin-bottom: 26px;
        color: #8E3F1A;
        /* margin-left: 5%; */
    }
    .perfil__experiencia {
        display: grid;
        grid-template-columns: repeat(3, max-content);
        align-items: center;
        justify-content: space-between;
        row-gap: 1rem;
        padding-bottom: 30px;
    }
    .salvar{
        background-color: #FBF7ED;
        border: 1px solid #FF9E0B;
        border-radius: 8px;
        color: #FF9E0B;
        font-size: 14px;
        padding: 8px 16px;
    }
    .profile-form {
        width: 100%;
        padding: 20px;
        border-radius: 5px;
        background-color: #FFFFFF;
    }

    .profile-form .form-group {
        margin-bottom: 15px;
    }
    .form-group label{
        color: rgba(0,0,0,.4);
        font-weight: 400;
        padding-bottom: 5px;
    }

    .profile-form label {
        display: block;
        margin-bottom: 5px;
    }

    .profile-form input[type="email"],
    .profile-form input[type="password"] {
        background-color: #fff;
        border: 1px solid rgba(234, 195, 157, .5);
        border-radius: 4px;
        color: rgba(0,0,0,.6);
        font-size: 16px;
        font-weight: 400;
        height: 48px;
        line-height: 48px;
        padding: 0 10px;
        transition: border .2s ease-in-out;
        width: 100%;
    }

    .profile-form button.salvar {
        background-color: #FBF7ED;
        border: 1px solid #FF9E0B;
        border-radius: 8px;
        color: #FF9E0B;
        font-size: 14px;
        padding: 8px 16px;
    }

    .profile-form button.salvar:hover {
        background-color: #FFFFFF;
    }
    .perfil__container{
        background-color: #fff;
        border: .9px solid #FF9E0B;
        border-radius: 12px;
        display: flex;
        justify-content: space-between;
        margin: 0 auto;
        padding: 30px 20px;
        width: 100%;  
    }
    .nome__col{
        border-right: 1px solid rgba(234, 195, 157, .5);
        margin-right: 20px;
        min-width: 212px;
        width: 20vw;
    }

    /* Novas classes para a seção de Adicionar Experiência */
    .experiencia__container {
        background-color: #fff;
        border: .9px solid #FF9E0B;
        border-radius: 12px;
        padding: 30px;
        margin: 20px auto;
        width: 100%;
    }

    .experiencia__item {
        margin-bottom: 20px;
    }

    .btn-remover {
        background-color: #FBF7ED;
        border: 1px solid #FF9E0B;
        border-radius: 8px;
        color: #FF9E0B;
        font-size: 14px;
        padding: 8px 16px;
    }

    .btn-remover:hover {
        background-color: #FFFFFF;
    }

    .add-experience-form .form-group {
        margin-bottom: 15px;
    }

    .add-experience-form label {
        color: rgba(0, 0, 0, .4);
        font-weight: 400;
        display: block;
        margin-bottom: 5px;
    }

    .add-experience-form .form-control {
        width: 100%;
        padding: 8px;
        border: 1px solid rgba(234, 195, 157, .5);
        border-radius: 4px;
        font-size: 16px;
        color: rgba(0, 0, 0, .6);
    }

    .add-experience-form button.salvar {
        background-color: #FBF7ED;
        border: 1px solid #FF9E0B;
        border-radius: 8px;
        color: #FF9E0B;
        font-size: 14px;
        padding: 8px 16px;
        margin-top: 10px;
    }

    .add-experience-form button.salvar:hover {
        background-color: #FFFFFF;
    }
</style>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('#current_job').change(function() {
            if(this.checked) {
                $('#end_date').prop('disabled', true);
                $('#end_date').val('');
            } else {
                $('#end_date').prop('disabled', false);
            }
        });
    });
</script>
@endsection

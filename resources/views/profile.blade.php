@extends('layouts.app')
@section('title') Личный кабинет @endsection

@section('content')
    <div class="container">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session()->has('profileUpdated'))
            <div class="alert alert-success text-center">
                Профиль успешно обновлен!
            </div>
        @endif

        @if (session()->has('currentPasswordError'))
            <div class="alert alert-warning text-center">
                Вы ввели неверный текущий пароль
            </div>
        @endif
            <main-info-profile-component :user="{{$user}}"></main-info-profile-component>
            <address-component :user="{{$user}}"></address-component>
            <password-component></password-component>
    </div>
@endsection

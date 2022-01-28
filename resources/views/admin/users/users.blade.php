@extends('admin.layouts.dashboard')

@section('header')
    @include('admin.layouts.parts.header')
@endsection

@section('navbar')
    @include('admin.layouts.parts.navbar')
@endsection

@section('sidebar')
    @include('admin.layouts.parts.sidebar')
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <table class="table table-borderd">
            <table class="table table-borderd mb-5">
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            <a href="{{ route('enterAsUser', $user->id) }}">
                                Войти
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            @if (session('startExportCategories'))
                <div class="alert alert-success">
                    Выгрузка категорий запущена
                </div>
            @endif

            <form method="post" action="{{ route('exportCategories') }}">
                @csrf
                <button type="submit" class="btn btn-link">Выгрузить категории</button>
            </form>
    </div>
@endsection

@section('footer')
    @include('admin.layouts.parts.footer')
@endsection

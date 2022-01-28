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
        <div class="row">
            <a href="{{ route('addCategory') }}" class="btn" title="Добавить"><i class="fas fa-plus-square"></i></a>
            <form method="post" action="{{ route('exportCategories') }}">
                @csrf
                <button type="submit" class="btn" title="выгрузить в CSV"><i class="fas fa-file-import"></i></button>
            </form>
            <form method="post" action="#">
                @csrf
                <button type="submit" class="btn" title="загрузить из CSV"><i class="fas fa-file-export"></i></button>
            </form>
        </div>

        <table class="table table-borderd">
            <table class="table table-borderd mb-5">
                <th>ID</th>
                <th>Фото</th>
                <th>Наименование</th>
                <th>Количество товаров</th>
                <th>Описание</th>
                <th>Редактировать</th>
                <th>Удалить</th>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{$category->id}}</td>
                        <td><img src="/storage/img{{$category->picture}}" width="30" alt=""></td>
                        <td>{{$category->name}}</td>
                        <td>{{count($category->products)}}</td>
                        <td>{{$category->description}}</td>
                        <td><a href="{{ route('editCategory', $category->id) }}" class="btn">
                                <i class="nav-icon fas fa-edit"></i>
                            </a></td>
                        <td><a href="{{ route('delCategory', $category->id) }}" class="btn">
                                <i class="nav-icon fas fa-trash"></i>
                            </a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            @if (session('startExportCategories'))
                <div class="alert alert-success">
                    Выгрузка категорий запущена
                </div>
            @endif
    </div>
@endsection

@section('footer')
    @include('admin.layouts.parts.footer')
@endsection

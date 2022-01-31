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
                <a href="{{route('addProducts')}}" class="btn" title="Добавить"><i class="fas fa-plus-square"></i></a>
                <form method="post" action="{{ route('exportProducts') }}">
                    @csrf
                    <button type="submit" class="btn" title="выгрузить в CSV"><i class="fas fa-file-import"></i></button>
                </form>
                <form method="post" action="{{ route('importProducts') }}">
                    @csrf
                    <button type="submit" class="btn" title="загрузить из CSV"><i class="fas fa-file-export"></i></button>
                </form>
{{--            <div class="col mt-2"> <label for="">Выбрать категорию</label>--}}
{{--                <form method="get" action="{{ route('allProducts') }}">--}}
{{--                <select name="category">--}}
{{--                    @foreach($categories as $category)--}}
{{--                    <option value="{{$category->id}}">{{$category->name}}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--                    <button type="submit">Выбрать</button>--}}
{{--                </form>--}}
{{--            </div>--}}
        </div>
        <table class="table table-borderd">
            <table class="table table-borderd mb-5">
                <th>ID</th>
                <th>Фото</th>
                <th>Наименование</th>
                <th>Описание</th>
                <th>Цена</th>
                <th>Категория</th>
                <th>Редактировать</th>
                <th>Удалить</th>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{$product->id}}</td>
                        <td><img src="/storage/img/{{$product->picture}}" width="30" alt=""></td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->description}}</td>
                        <td>{{$product->price}}</td>
                        <td>{{$product->category->name}}</td>
                        <td><a href="{{ route('editProduct', $product->id) }}" class="btn">
                                <i class="nav-icon fas fa-edit"></i>
                            </a></td>
                        <td><a href="{{ route('delProduct', $product->id) }}" class="btn">
                                <i class="nav-icon fas fa-trash"></i>
                            </a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            @if (session('startExportProducts'))
                <div class="alert alert-success">Выгрузка товаров запущена</div>
            @endif
            @if (session('startImportProducts'))
                <div class="alert alert-success">Загрузка товаров запущена</div>
            @endif
    </div>
@endsection

@section('footer')
    @include('admin.layouts.parts.footer')
@endsection

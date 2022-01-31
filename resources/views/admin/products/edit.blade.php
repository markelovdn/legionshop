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
        <form action="{{ route('updateProduct') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
            <div class="form-group">
                <label for="exampleInputEmail1">Наименование</label>
                <input type="text" name="id" value="{{$product->id}}" class="form-control" style="display: none" autocomplete="on">
                <input type="text" name="name" value="{{$product->name}}" class="form-control" autocomplete="on">
                <label>Цена</label>
                <input type="text" name="price" value="{{$product->price}}" class="form-control" autocomplete="on">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Описание</label>
                <textarea type="text" name="description" class="form-control">{{$product->description}}</textarea>
            </div>
            <label>Изображение</label>
            <div class="form-group">
                <img src="/storage/img/{{$product->picture}}" width="100" alt="">
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" name="picture" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                    <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                    </div>
                </div>
                <label>Категория</label>
                <select class="form-control" name="category_id">
                    @foreach($categories as $category)
                    <option @if ($product->category_id == $category->id) selected @endif value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-success mt-3">Сохранить</button>
            </div>
        </div>

        </form>

    </div>
@endsection

@section('footer')
    @include('admin.layouts.parts.footer')
@endsection

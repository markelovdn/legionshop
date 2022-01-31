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
        <form action="{{ route('updateCategory') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
            <div class="form-group">
                <label for="exampleInputEmail1">Наименование</label>
                <input type="text" name="id" value="{{$category->id}}" class="form-control" style="display:none;" autocomplete="on">
                <input type="text" name="name" value="{{$category->name}}" class="form-control" autocomplete="on">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Описание</label>
                <textarea type="text" name="description" class="form-control">{{$category->description}}</textarea>
            </div>
            <label>Изображение</label>
            <div class="form-group">
                <img src="/storage/img/{{$category->picture}}" width="100" alt="">
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" name="picture" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                    <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                    </div>
                </div>
                <button type="submit" class="btn btn-success mt-3">Сохранить</button>
            </div>
        </div>

        </form>

    </div>
@endsection

@section('footer')
    @include('admin.layouts.parts.footer')
@endsection

@extends('layouts/admin_layout')


@section('title', 'Редактирование - О проекте')

@section('content')
    <div class="container-fluid pb-4">
        <div class="row">
            <div class="col-12">
                <h1>Редактирование - О проекте</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4 class="mb-0"><i class="icon fa fa-check"></i>{{ session('success') }}</h4>
                        <a href="/administrator/">Вернуться</a>
                    </div>
                @endif
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12">
                <a href="/administrator/">К Вернуться</a>
            </div>
        </div>
        <!-- form start -->
        <form method="POST" action="{{ route('page.update', $page->id) }}">
            @csrf
            @method('PUT')

            <div class="row">
                @csrf
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-body">

                            <input type="text" hidden name="page_id" value="{{ $page->id }}">

                            <div class="form-group">
                                <label for="exampleInputEmail1">Содержимое страницы</label>
                                <textarea name="content" id="" cols="30" rows="20" class="form-control">{{ $page->content }}</textarea>
                            </div>




                        </div>
                        <!-- /.card-body -->
                    </div>

                </div>
                <!--/.col (left) -->
                <div class="col-md-8 text-left">


                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </div>
        </form>
    </div>
@endsection

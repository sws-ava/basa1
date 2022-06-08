@extends('layouts/admin_layout')


@section('title', 'Добавить значок')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Добавление значка</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4 class="mb-0"><i class="icon fa fa-check"></i>{{ session('success') }}</h4>
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
                <!-- general form elements -->
                <div class="card card-primary">
                    <!-- form start -->
                    <form method="POST" action="{{ route('badge.store') }}">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Название значка</label>
                                <input type="text" name="title" class="form-control" placeholder="Введите название значка"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Описание значка</label>
                                <input type="text" name="description" class="form-control"
                                    placeholder="Введите описание значка" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Порядок вывода</label>
                                <input type="number" name="order" class="form-control"
                                    placeholder="Введите порядок вывода" required>
                            </div>
                            <div class="form-group">
                                <label for="feature_image">Картинка</label>
                                <img class="img-uploaded" src="" alt=""
                                    style="display: block; margin-bottom: 20px; max-width: 100px;">
                                <input type="text" id="feature_image" name="img" value="" hidden required>
                                <a href="" class="popup_selector" data-inputid="feature_image">Выбрать картинку</a>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Добавить</button>
                        </div>
                    </form>
                </div>
            </div>
            <!--/.col (left) -->
        </div>
    </div>
@endsection

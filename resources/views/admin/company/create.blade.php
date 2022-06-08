@extends('layouts/admin_layout')


@section('title', 'Добавить компанию')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Добавление компании</h1>
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
        <!-- form start -->
        <form method="POST" action="{{ route('company.store') }}">
            <div class="row">
                @csrf
                <!-- left column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Название (для каталога)</label>
                                <input type="text" name="name" class="form-control"
                                    placeholder="Введите название компании" maxlength="250" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Описание мини</label>
                                <input type="text" name="short" class="form-control"
                                    placeholder="Введите описание компании" maxlength="160">
                            </div>
                            <div class="form-group">
                                <label for="countrySelectMain" class="d-block">Страна</label>
                                <select name="country" id="countrySelectMain " class="form-control countrySelectMain"
                                    required>
                                    <option value="">Выбрать</option>
                                    @foreach ($company_countries as $company_country)
                                        <option value="{{ $company_country->id }}">{{ $company_country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputSelect2" class="d-block">Область</label>
                                <select name="region" id="exampleInputSelect2" class="form-control select2" required>
                                    <option value="">Выбрать</option>
                                    @foreach ($regions as $region)
                                        <option value="{{ $region->id }}">{{ $region->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputSelect3" class="d-block">Город</label>
                                <select name="city" id="exampleInputSelect3" class="form-control select2" required>
                                    <option value="">Выбрать</option>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <!--/.col (left) -->
                <!-- right column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Адрес (улица, дом)</label>
                                <input type="text" name="address" class="form-control" placeholder="Введите адрес">
                            </div>
                            <div class="form-group">
                                <label for="">Индекс</label>
                                <input type="text" name="index" class="form-control" maxlength="6"
                                    placeholder="Введите индекс">
                            </div>
                            <div class="form-group">
                                <label for="">Э-почта для каталога</label>
                                <input type="text" name="email" class="form-control" placeholder="Введите email"
                                    pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
                            </div>
                            <div class="form-group">
                                <label for="">Сайт (sitename.ru / sitename.ru.ru)</label>
                                <input type="text" name="site" class="form-control" placeholder="Введите адрес">
                            </div>
                            <div class="form-group">
                                <label for="">Телефон</label>
                                <input type="text" name="phone" class="form-control phoneInput"
                                    placeholder="Введите телефон">
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <!--/.col (right) -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Номер сортировки</label>
                                <div>
                                    Градиции категорий:
                                    <br>
                                    1-69 - Все компании
                                    <br>
                                    70-79 - Платная анкета
                                    <br>
                                    80-89 - Члены ассоциации 7/89
                                    <br>
                                    90-100 - Спонсоры
                                    <br>
                                    <br>
                                </div>
                                <input type="number" name="sort_num" value="" class="form-control"
                                    placeholder="Введите номер сортировки">
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <div class="col-12 text-center">

                    <button type="submit" class="btn btn-primary">Добавить</button>
                </div>
            </div>
        </form>
    </div>
@endsection

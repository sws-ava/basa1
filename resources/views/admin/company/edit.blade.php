@extends('layouts/admin_layout')


@section('title', 'Редактирование компании')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Редактирование компании</h1>
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
        <a class="d-block my-4" href="/administrator/company/{{ $company['id'] }}">К компании</a>
        <!-- form start -->
        <form method="POST" action="{{ route('company.update', $company['id']) }}">
            @csrf
            @method('PUT')

            <div class="row">
                @csrf
                <!-- left column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-body">
                            <input type="text" hidden name="company_id" value="{{ $company['id'] }}">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Название (для каталога)</label>
                                <input type="text" name="name" value="{{ $company['name'] }}" class="form-control"
                                    placeholder="Введите название компании" maxlength="250" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Описание мини</label>
                                <input type="text" name="short" value="{{ $company['short'] }}" class="form-control"
                                    placeholder="Введите описание компании" maxlength="160">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputSelect1" class="d-block">Страна</label>
                                <select name="country" id="exampleInputSelect1 " class="form-control countrySelectMain"
                                    required>
                                    @foreach ($company_countries as $company_country)
                                        <option value="{{ $company_country->id }}"
                                            @if ($company_country->id == $company['country_id']) selected @endif>
                                            {{ $company_country->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputSelect2" class="d-block">Область</label>
                                <select name="region" id="exampleInputSelect2" class="form-control select2" required>
                                    @foreach ($regions as $region)
                                        <option value="{{ $region->id }}"
                                            @if ($region->id == $company['district_id']) selected @endif>
                                            {{ $region->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputSelect3" class="d-block">Город</label>
                                <select name="city" id="exampleInputSelect3" class="form-control select2" required>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}"
                                            @if ($city->id == $company['city_id']) selected @endif>
                                            {{ $city->name }}
                                        </option>
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
                                <input type="text" name="address" value="{{ $company['address'] }}"
                                    class="form-control" placeholder="Введите адрес">
                            </div>
                            <div class="form-group">
                                <label for="">Индекс</label>
                                <input type="text" name="index" value="{{ $company['index'] }}" maxlength="6"
                                    class="form-control" placeholder="Введите индекс">
                            </div>
                            <div class="form-group">
                                <label for="">Э-почта для каталога</label>
                                <input type="text" name="email" value="{{ $company['email'] }}" class="form-control"
                                    placeholder="Введите email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
                            </div>
                            <div class="form-group">
                                <label for="">Сайт (sitename.ru / sitename.ru.ru)</label>
                                <input type="text" name="site" value="{{ $company['site'] }}" class="form-control"
                                    placeholder="Введите адрес">
                            </div>
                            <div class="form-group">
                                <label for="">Телефон</label>
                                <input type="text" name="phone" value="{{ $company['phone'] }}"
                                    class="form-control phoneInput" placeholder="Введите телефон">
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
                                <input type="number" name="sort_num" value="{{ $company['sort_num'] }}"
                                    class="form-control" placeholder="Введите номер сортировки">
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>



                <div class="col-12 text-center">

                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </div>
        </form>
    </div>
@endsection

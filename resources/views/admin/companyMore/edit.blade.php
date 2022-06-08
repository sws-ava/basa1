@extends('layouts/admin_layout')


@section('title', 'Расширенная информация компании')

@section('content')
    <div class="container-fluid pb-4">
        <div class="row">
            <div class="col-12">
                <h1>Расширенная информация компании</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4 class="mb-0"><i class="icon fa fa-check"></i>{{ session('success') }}</h4>
                        <a href="/administrator/company/{{ $company_id }}">К компании</a>
                    </div>
                @endif
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12">
                <a href="/administrator/company/{{ $company_id }}">К компании</a>
            </div>
        </div>
        <!-- form start -->
        <form method="POST" action="{{ route('companyMore.update', $company_id) }}">
            @csrf
            @method('PUT')

            <div class="row">
                @csrf
                <!-- left column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-body">
                            <h3><u>Основные</u></h3>


                            <input type="text" hidden name="company_id" value="{{ $company_id }}">

                            <div class="form-group">
                                <label for="exampleInputEmail1">Название юрлица</label>
                                <input type="text" name="entity" value="{{ $company->entity }}" class="form-control"
                                    placeholder="Введите название юрлица" maxlength="250">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Год основания</label>
                                <select class="form-control" name="foundation" id="">
                                    <option value="0">Выбрать</option>
                                    @for ($i = 1980; $i <= 2023; $i++)
                                        @if ($company->foundation == $i)
                                            <option selected value="{{ $i }}">{{ $i }}</option>
                                        @else
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endif
                                    @endfor
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Организационно правовая форма</label>
                                {{ $company->legal_form }}
                                <select class="form-control" name="legal_form" id="">
                                    <option @if ($company->legal_form == 0) selected @endif value="0">Выбрать</option>
                                    <option @if ($company->legal_form == 1) selected @endif value="1">Коммерческая
                                        компания в форме юридического лица (ООО, АО и т.д.) </option>
                                    <option @if ($company->legal_form == 2) selected @endif value="2">Некоммерческая
                                        компания в форме юридического лица (НП, АНО, Фонд и т.д.)</option>
                                    <option @if ($company->legal_form == 3) selected @endif value="3">Государственное или
                                        муниципальное предприятие, учреждение</option>
                                    <option @if ($company->legal_form == 4) selected @endif value="4">Предприниматель,
                                        зарегистрированный в форме ИП</option>
                                    <option @if ($company->legal_form == 5) selected @endif value="5">Неформальный
                                        коллектив, «бригада»</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Форма собственности</label>
                                <select class="form-control" name="ownership" id="">
                                    <option @if ($company->legal_form == 0) selected @endif value="0">Выбрать</option>
                                    <option @if ($company->ownership == 1) selected @endif value="1">Самостоятельная
                                        организация или группа организаций
                                    </option>
                                    <option @if ($company->ownership == 2) selected @endif value="2">
                                        Филиал более крупной компании, дочернее предприятие</option>
                                    <option @if ($company->ownership == 3) selected @endif value="3">Департамент,
                                        подразделение, отдел учреждения </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">ИНН</label>
                                <input type="text" name="inn" value="{{ $company->inn }}" class="form-control"
                                    placeholder="Введите ИНН" maxlength="250">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">ОГРН</label>
                                <input type="text" name="ogrn" value="{{ $company->ogrn }}" class="form-control"
                                    placeholder="Введите ОГРН" maxlength="250">
                            </div>



                        </div>
                        <!-- /.card-body -->
                    </div>

                </div>
                <!--/.col (left) -->

                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-body">
                            <h3><u>Социальные сети</u></h3>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Ссылка на ФБ</label>
                                <input type="text" name="fb" value="{{ $company->fb }}" class="form-control"
                                    placeholder="Ссылка на ФБ" maxlength="250">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Ссылка на Твиттер</label>
                                <input type="text" name="tw" value="{{ $company->tw }}" class="form-control"
                                    placeholder="Ссылка на Твиттер" maxlength="250">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Cсылка на Телеграм</label>
                                <input type="text" name="tg" value="{{ $company->tg }}" class="form-control"
                                    placeholder="Cсылка на Телеграм" maxlength="250">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Ccылка на Инстаграм</label>
                                <input type="text" name="insta" value="{{ $company->insta }}" class="form-control"
                                    placeholder="Cсылка на Инстаграм" maxlength="250">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Cсылка на Вотсап</label>
                                <input type="text" name="whatsup" value="{{ $company->whatsup }}" class="form-control"
                                    placeholder="Cсылка на Вотсап" maxlength="250">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Cсылка на ВК</label>
                                <input type="text" name="vk" value="{{ $company->vk }}" class="form-control"
                                    placeholder="Cсылка на ВК" maxlength="250">
                            </div>

                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <div class="col-md-6">

                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-body">
                            <h3><u>Сотрудники</u></h3>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Количество штатных сотрудников</label>
                                <input type="text" name="shtat" value="{{ $company->shtat }}" class="form-control"
                                    placeholder="Количество штатных сотрудников" maxlength="4">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Количество аналитиков</label>
                                <input type="text" name="analit" value="{{ $company->analit }}" class="form-control"
                                    placeholder="Количество аналитиков" maxlength="4">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Количество менеджеров проектов</label>
                                <input type="text" name="managers" value="{{ $company->managers }}"
                                    class="form-control" placeholder="Количество менеджеров проектов" maxlength="4">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Количество внештатных сотрудников</label>
                                <input type="text" name="noshtat" value="{{ $company->noshtat }}" class="form-control"
                                    placeholder="Количество внештатных сотрудников" maxlength="4">
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-6">

                    <div class="card card-primary">
                        <div class="card-body">

                            <div class="form-group">
                                <label>Филиалы компании</label>
                                <select name="filials[]" class="select2" multiple="multiple"
                                    data-placeholder="Филиалы" style="width: 100%;">
                                    @foreach ($cities as $c)
                                        @if ($filials)
                                            @foreach ($filials as $f)
                                                @if ($c->id == $f)
                                                    <option selected value="{{ $c->id }}">{{ $c->name }}
                                                    </option>
                                                @else
                                                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                                                @endif
                                            @endforeach
                                        @else
                                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="card card-primary">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Города проведения работ</label>
                                <select name="work_cities[]" class="select2" multiple="multiple"
                                    data-placeholder="Выбрать города проведения работ" style="width: 100%;">
                                    @foreach ($cities as $c)
                                        @if ($work_cities)
                                            @foreach ($work_cities as $f)
                                                @if ($c->id == $f)
                                                    <option selected value="{{ $c->id }}">{{ $c->name }}
                                                    </option>
                                                @else
                                                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                                                @endif
                                            @endforeach
                                        @else
                                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="card card-primary">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Области проведения работ</label>
                                <select name="work_regions[]" class="select2" multiple="multiple"
                                    data-placeholder="Выбрать области проведения работ" style="width: 100%;">
                                    @foreach ($regions as $c)
                                        @if ($work_regions)
                                            @foreach ($work_regions as $f)
                                                @if ($c->id == $f)
                                                    <option selected value="{{ $c->id }}">{{ $c->name }}
                                                    </option>
                                                @else
                                                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                                                @endif
                                            @endforeach
                                        @else
                                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
                <style>
                    .note-editing-area {
                        min-height: 200px;
                    }

                </style>
                <div class="col-md-12">
                    <div class="card card-outline card-info">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <textarea name="largeText" style="min-height: 200px; width: 100%;" id="">{{ $company->largeText }}</textarea>
                        </div>

                    </div>
                </div>
                <div class="col-md-8 text-right">

                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </div>
        </form>
    </div>
@endsection

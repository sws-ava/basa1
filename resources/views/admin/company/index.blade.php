@extends('layouts/admin_layout')


@section('title', 'Все компании')


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                {{-- <h1>Все компании</h1> --}}
            </div>
        </div>

        <style>
            .card-title {
                /* border-bottom: 1px solid #bebebe; */
                padding-bottom: 10px;

            }

        </style>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4>{{ $company['name'] }}</h4>
                        <div class="text-right mb-3">

                            @if ($company['show'] == 0)
                                <div class="d-flex align-items-center justify-content-end">
                                    <span class="mr-4" style="color: red; font-weight: 700;">Не
                                        показывается</span>
                                    <form method="POST" action="{{ route('show', $company['id']) }}">
                                        @csrf
                                        <input type="text" hidden name="company_id" value="{{ $company['id'] }}">
                                        <input type="text" hidden name="show" value="1">
                                        <button type="submit" class="btn btn-block btn-success"
                                            style="    max-width: 180px; margin-left: auto;">
                                            Включить
                                        </button>
                                    </form>
                                </div>
                            @else
                                <div class="d-flex align-items-center justify-content-end">
                                    <span class="mr-4"
                                        style="color: rgb(3, 127, 3); font-weight: 800;">Показывается</span>
                                    <form method="POST" action="{{ route('show', $company['id']) }}">
                                        @csrf
                                        <input type="text" hidden name="company_id" value="{{ $company['id'] }}">
                                        <input type="text" hidden name="show" value="0">
                                        <button type="submit" class="btn btn-block btn-danger"
                                            style="    max-width: 180px; margin-left: auto;">
                                            Выключить
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>



                        <div class="text-right mb-3">

                            @if ($company['isTop'] == 0)
                                <div class="d-flex align-items-center justify-content-end">
                                    <form method="POST" action="{{ route('top', $company['id']) }}">
                                        @csrf
                                        <input type="text" hidden name="company_id" value="{{ $company['id'] }}">
                                        <input type="text" hidden name="top" value="1">
                                        <button type="submit" class="btn btn-block btn-success"
                                            style="    max-width: 180px; margin-left: auto;">
                                            Включить показ проплаченной анкеты
                                        </button>
                                    </form>
                                </div>
                            @else
                                <div class="d-flex align-items-center justify-content-end">
                                    <form method="POST" action="{{ route('top', $company['id']) }}">
                                        @csrf
                                        <input type="text" hidden name="company_id" value="{{ $company['id'] }}">
                                        <input type="text" hidden name="top" value="0">
                                        <button type="submit" class="btn btn-block btn-danger"
                                            style="    max-width: 180px; margin-left: auto;">
                                            Выключить показ проплаченной анкеты
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>




                        <div>
                            <style>
                                #accordion .card-header,
                                #accordion .card-body {
                                    padding: 5px 0;
                                }

                                #accordion .card-body .btn-warning {
                                    margin-top: 10px;
                                    max-width: 40px;
                                }

                            </style>
                            <div id="accordion">
                                <div class="">
                                    <div class="card-header pl-0" style="    border: none;">
                                        <h4 class="card-title w-100">
                                            <a class="d-block w-100" data-toggle="collapse" href="#collapse1">
                                                Профайл компании
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapse1" class="collapse" data-parent="#accordion">
                                        <div class="card-body">
                                            <div style="color: #4e4d4d; font-size: 16px;">
                                                <b>Описание:</b> {{ $company['short'] }} <br>
                                                <b>Адрес:</b> {{ $country_id->name }},
                                                {{ $region_id->name }},
                                                {{ $city_id->name }},
                                                {{ $company['address'] }},
                                                {{ $company['index'] }}<br>
                                                <b>Телефон:</b> {{ $company['phone'] }}<br>
                                                <b>E-mail:</b> {{ $company['email'] }}<br>
                                                <b>Сайт:</b> {{ $company['site'] }}<br>
                                            </div>
                                            <a href="{{ route('company.edit', $company['id']) }}"
                                                class="btn btn-block btn-warning mb-2">
                                                <i class="fas fa-pencil-alt mr-2"></i>
                                            </a>
                                            <div class=" mt-4">
                                                <b>Логотип компании:</b><br>
                                                @if ($logo)
                                                    <img class="mb-4" style="max-width: 300px; max-height: 200px;"
                                                        src="/storage/{{ $logo->company_logo_name }}" alt="">
                                                    <form class="" method="POST"
                                                        action="{{ route('companyLogo.destroy', $logo->company_logo_id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class=" mb-4 btn btn-block btn-danger delete-btn"
                                                            style="    max-width: 180px;">
                                                            <i class="fas fa-trash mr-2"></i>
                                                            Удалить логотип
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                            <a href="{{ route('companyLogo.edit', $company['id']) }}"
                                                class="btn btn-block btn-warning mb-2 d-flex"
                                                style="max-width: 340px;  align-items: center;">
                                                <i class="fas fa-pencil-alt mr-2"></i>
                                                Редактировать логотип компании
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="card-header pl-0" style="    border: none;">
                                        <h4 class="card-title w-100">
                                            <a class="d-block w-100" data-toggle="collapse" href="#collapse2">
                                                Дополнительные данные о компании
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapse2" class="collapse" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="mb-4" style="color: #4e4d4d; font-size: 16px;">
                                                <h5><u>Основные</u></h5>
                                                <b>Название юрлица:</b> {{ $company['entity'] }} <br>
                                                <b>Год основания:</b> {{ $company['foundation'] }} <br>
                                                <b>Организационно правовая форма:</b>


                                                @if ($company->legal_form == 1)
                                                    Коммерческая компания в форме юридического лица (ООО, АО и т.д.)
                                                @endif
                                                @if ($company->legal_form == 2)
                                                    Некоммерческая компания в форме юридического лица (НП, АНО, Фонд и т.д.)
                                                @endif
                                                @if ($company->legal_form == 3)
                                                    Государственное или муниципальное предприятие, учреждение
                                                @endif
                                                @if ($company->legal_form == 4)
                                                    Предприниматель, зарегистрированный в форме ИП
                                                @endif
                                                @if ($company->legal_form == 5)
                                                    Неформальный коллектив, «бригада»
                                                @endif
                                                <br>
                                                <b>Форма собственности:</b>


                                                @if ($company->ownership == 1)
                                                    Самостоятельная организация или группа организаций
                                                @endif

                                                @if ($company->ownership == 2)
                                                    Филиал более крупной компании, дочернее предприятие
                                                @endif

                                                @if ($company->ownership == 3)
                                                    Департамент, подразделение, отдел учреждения
                                                @endif
                                                <br>
                                                <b>ИНН:</b> {{ $company['inn'] }} <br>
                                                <b>ОГРН:</b> {{ $company['ogrn'] }} <br>
                                            </div>
                                            <div class="mb-4" style="color: #4e4d4d; font-size: 16px;">
                                                <h5><u>Социальные сети</u></h5>
                                                @if ($company['fb'])
                                                    <a target="_blank" href="//{{ $company['fb'] }}">Facebook</a> <br>
                                                @endif
                                                @if ($company['tw'])
                                                    <a target="_blank" href="//{{ $company['tw'] }}">Твиттер</a> <br>
                                                @endif
                                                @if ($company['tg'])
                                                    <a target="_blank" href="//{{ $company['tg'] }}">Телеграм</a>
                                                    <br>
                                                @endif
                                                @if ($company['insta'])
                                                    <a target="_blank" href="//{{ $company['insta'] }}">Инстаграм</a>
                                                    <br>
                                                @endif
                                                @if ($company['whatsup'])
                                                    <a target="_blank" href="//{{ $company['whatsup'] }}">
                                                        Вотсап</a>
                                                    <br>
                                                @endif
                                                @if ($company['vk'])
                                                    <a target="_blank" href="//{{ $company['vk'] }}">ВК</a> <br>
                                                @endif
                                            </div>
                                            <div class="mb-4" style="color: #4e4d4d; font-size: 16px;">
                                                <h5><u>Сотрудники</u></h5>
                                                <b>Количество штатных сотрудников:</b> {{ $company['shtat'] }} <br>
                                                <b>Количество аналитиков:</b> {{ $company['analit'] }}<br>
                                                <b>Количество менеджеров проектов:</b> {{ $company['managers'] }}<br>
                                                <b>Количество внештатных сотрудников:</b> {{ $company['noshtat'] }}<br>
                                            </div>
                                            <div class="mb-4" style="color: #4e4d4d; font-size: 16px;">
                                                <h5><u>Филиалы</u></h5>
                                                @if ($filials)
                                                    @foreach ($filials as $f)
                                                        @foreach ($cities as $c)
                                                            @if ($c->id == $f)
                                                                <b>{{ $c->name }}</b> <br>
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                @endif
                                            </div>

                                            <a href="{{ route('companyMore.edit', $company['id']) }}"
                                                class="btn btn-block btn-warning mb-2">
                                                <i class="fas fa-pencil-alt mr-2"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="card-header pl-0" style="    border: none;">
                                        <h4 class="card-title w-100">
                                            <a class="d-block w-100" data-toggle="collapse" href="#collapse10">
                                                Файлы - презентации
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapse10" class="collapse" data-parent="#accordion">
                                        <div class="card-body">
                                            <a href="{{ route('companyFile.create', ['company' => $company['id'], 'file_cat' => 1]) }}"
                                                type="submit" class="btn btn-block btn-success"
                                                style=" margin-bottom: 20px;   max-width: 280px; margin-right: auto;"
                                                class="d-block mb-4">
                                                <i class="fas fa-plus mr-2"></i>
                                                Добавить презентацию
                                            </a>

                                            @foreach ($presentationFiles as $pf)
                                                @if ($pf->category == 1)
                                                    <a target="_blank" class="mr-4"
                                                        href="/storage/{{ $pf->file }}">{{ $pf->title }}
                                                    </a>
                                                    <div class="d-flex align-items-baseline mb-4 ">
                                                        <a href="/administrator/companyFile/{{ $pf->id }}/edit"
                                                            class="btn btn-block btn-warning mr-4"
                                                            style="    max-width: 180px;">
                                                            <i class="fas fa-pencil-alt mr-2"></i>
                                                            Редактировать
                                                        </a>
                                                        <form class="mr-4" method="POST"
                                                            action="{{ route('companyFile.destroy', $pf->id) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-block btn-danger delete-btn"
                                                                style="    max-width: 180px;">
                                                                <i class="fas fa-trash mr-2"></i>
                                                                Удалить файл
                                                            </button>
                                                        </form>

                                                    </div>

                                                    <a style="color: #000;" target="_blank"
                                                        href="/storage/{{ $pf->file }}">

                                                    </a>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="card-header pl-0" style="    border: none;">
                                        <h4 class="card-title w-100">
                                            <a class="d-block w-100" data-toggle="collapse" href="#collapse3">
                                                Специализации
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapse3" class="collapse" data-parent="#accordion">
                                        <div class="card-body">

                                            @if ($spec_works)
                                                @foreach ($spec_cats as $cat)
                                                    <span style="font-weight: 700">{{ $cat->spec_cat_name }}</span>

                                                    @foreach ($spec_works as $sw)
                                                        <div>
                                                            @foreach ($spec_works_items as $swi)
                                                                @if ($cat->spec_cat_id == $swi->spec_item_cat_id)
                                                                    @if ($swi->spec_item_id == $sw)
                                                                        <span class="pl-3">•
                                                                            {{ $swi->spec_item_name }}</span>
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    @endforeach
                                                @endforeach
                                            @else
                                                Ничего нет
                                            @endif

                                            <a href="{{ route('specWorks.edit', $company['id']) }}"
                                                class="btn btn-block btn-warning mb-2">
                                                <i class="fas fa-pencil-alt mr-2"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="card-header pl-0" style="    border: none;">
                                        <h4 class="card-title w-100">
                                            <a class="d-block w-100" data-toggle="collapse" href="#collapse4">
                                                Полевые работы
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapse4" class="collapse" data-parent="#accordion">
                                        <div class="card-body">

                                            <div style="color: #4e4d4d; font-size: 16px;">
                                                @if ($field_works)


                                                    @foreach ($field_works as $fw)
                                                        <div>
                                                            @foreach ($field_works_items as $fwi)
                                                                @if ($fwi->field_works_item_id == $fw)
                                                                    <span class="pl-3">•
                                                                        {{ $fwi->field_works_item_name }}</span>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    @endforeach
                                                @else
                                                    Ничего нет
                                                @endif
                                            </div>
                                            <a href="{{ route('fieldWorks.edit', $company['id']) }}"
                                                class="btn btn-block btn-warning mb-2">
                                                <i class="fas fa-pencil-alt mr-2"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="card-header pl-0" style="    border: none;">
                                        <h4 class="card-title w-100">
                                            <a class="d-block w-100" data-toggle="collapse" href="#collapse5">
                                                Ресурсы
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapse5" class="collapse" data-parent="#accordion">
                                        <div class="card-body">

                                            @if ($resources)
                                                @foreach ($resources_cats as $cat)
                                                    <div class="row mb-4">
                                                        <div class="col-12">
                                                            <span
                                                                style="font-weight: 700;">{{ $cat->resources_cats_name }}
                                                            </span>
                                                        </div>
                                                        @foreach ($resources_items as $item)
                                                            @if ($cat->resources_cats_id == $item->resources_items_cat)
                                                                @if ($item->resources_items_type == 'checkbox')
                                                                    @if ($resources_arr)
                                                                        @foreach ($resources_arr as $r)
                                                                            @if ($item->resources_items_id == $r)
                                                                                <div class="col-12 pl-3">
                                                                                    • {{ $item->resources_items_name }}
                                                                                </div>
                                                                            @endif
                                                                        @endforeach
                                                                    @endif
                                                                @else
                                                                    @if ($item->resources_items_id == 3)
                                                                        <div class="col-12 pl-3">
                                                                            • {{ $item->resources_items_name }}:
                                                                            <b>{{ $company_resources_operators }}</b>
                                                                        </div>
                                                                    @elseif ($item->resources_items_id == 4)
                                                                        <div class="col-12 pl-3">
                                                                            • {{ $item->resources_items_name }}:
                                                                            <b>{{ $company_resources_work_hours }}</b>
                                                                        </div>
                                                                    @elseif ($item->resources_items_id == 5)
                                                                        <div class="col-12 pl-3">
                                                                            • {{ $item->resources_items_name }}:
                                                                            <b>{{ $company_resources_focus_rooms }}</b>
                                                                            @if ($company_resources_focus_rooms > 0)
                                                                                <a href="{{ route('companyPhoto.index', ['company' => $company['id'], 'cat' => 1]) }}"
                                                                                    type="submit"
                                                                                    class="btn btn-block btn-success ml-2"
                                                                                    style=" display: inline; width: max-content;   max-width: 280px; margin-right: auto;"
                                                                                    class="d-block mb-4">
                                                                                    <i class="fas fa-plus mr-2"></i>
                                                                                    Добавить фото
                                                                                </a>
                                                                            @endif
                                                                        </div>
                                                                    @elseif ($item->resources_items_id == 16)
                                                                        <div class="col-12 pl-3">
                                                                            • {{ $item->resources_items_name }}:
                                                                            <b>{{ $company_resources_placements }}</b>
                                                                            @if ($company_resources_placements > 0)
                                                                                <a href="{{ route('companyPhoto.index', ['company' => $company['id'], 'cat' => 2]) }}"
                                                                                    type="submit"
                                                                                    class="btn btn-block btn-success ml-2"
                                                                                    style=" display: inline; width: max-content;   max-width: 280px; margin-right: auto;"
                                                                                    class="d-block mb-4">
                                                                                    <i class="fas fa-plus mr-2"></i>
                                                                                    Добавить фото
                                                                                </a>
                                                                            @endif
                                                                        </div>
                                                                    @elseif ($item->resources_items_id == 17)
                                                                        <div class="col-12 pl-3">
                                                                            • {{ $item->resources_items_name }}:
                                                                            <b>{{ $company_resources_placements_area }}</b>
                                                                        </div>
                                                                    @elseif ($item->resources_items_id == 19)
                                                                        <div class="col-12 pl-3">
                                                                            • {{ $item->resources_items_name }}:
                                                                            <b>{{ $company_resources_tablets }}</b>
                                                                        </div>
                                                                    @elseif ($item->resources_items_id == 20)
                                                                        <div class="col-12 pl-3">
                                                                            • {{ $item->resources_items_name }}:
                                                                            <b>{{ $company_resources_tablets_more }}</b>
                                                                        </div>
                                                                    @elseif ($item->resources_items_id == 29)
                                                                        <div class="col-12 pl-3">
                                                                            • {{ $item->resources_items_name }}:
                                                                            <b>{{ $company_resources_interviewers }}</b>
                                                                        </div>
                                                                    @elseif ($item->resources_items_id == 30)
                                                                        <div class="col-12 mt-4">
                                                                            <b>{{ $item->resources_items_name }}</b> :
                                                                            @foreach ($regions as $r)
                                                                                @if ($company_regions)
                                                                                    @foreach ($company_regions as $cr)
                                                                                        @if ($r->id == $cr)
                                                                                            <div class=" pl-3">
                                                                                                {{ $r->name }}
                                                                                            </div>
                                                                                        @endif
                                                                                    @endforeach
                                                                                @endif
                                                                            @endforeach
                                                                        </div>
                                                                    @endif
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                @endforeach
                                            @else
                                                Ничего нет
                                            @endif




                                            <a href="{{ route('companyResources.edit', $company['id']) }}"
                                                class="btn btn-block btn-warning mb-2">
                                                <i class="fas fa-pencil-alt mr-2"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="card-header pl-0" style="    border: none;">
                                        <h4 class="card-title w-100">
                                            <a class="d-block w-100" data-toggle="collapse" href="#collapse6">
                                                Решения для рисерча
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapse6" class="collapse" data-parent="#accordion">
                                        <div class="card-body">
                                            @if ($research_solutions_q)
                                                <div><b>Выбрано:</b>
                                                </div>
                                                @foreach ($research_solutions_items as $rs_items)
                                                    @foreach ($research_solutions_q as $q)
                                                        @if ($rs_items->research_solutions_items_id == $q)
                                                            <div>
                                                                • {{ $rs_items->research_solutions_items_name }}
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            @endif

                                            @if ($research_solutions_own)
                                                <div class="mt-3"><b>Свои варианты:</b></div>
                                                @for ($i = 0; $i < 3; $i++)
                                                    <div>
                                                        @if ($research_solutions_own[$i] != null)
                                                            • {{ $research_solutions_own[$i] }}
                                                        @endif
                                                    </div>
                                                @endfor
                                            @endif
                                            <a href="{{ route('researchSolutions.edit', $company['id']) }}"
                                                class="btn btn-block btn-warning mb-2">
                                                <i class="fas fa-pencil-alt mr-2"></i>
                                            </a>


                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="card-header pl-0" style="    border: none;">
                                        <h4 class="card-title w-100">
                                            <a class="d-block w-100" data-toggle="collapse" href="#collapse7">
                                                Руководители
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapse7" class="collapse" data-parent="#accordion">
                                        <div class="card-body">

                                            <a href="{{ route('head.create', ['company' => $company['id']]) }}"
                                                type="submit" class="btn btn-block btn-success"
                                                style=" margin-bottom: 20px;   max-width: 280px; margin-right: auto;"
                                                class="d-block mb-4">
                                                <i class="fas fa-plus mr-2"></i>
                                                Добавить руководителя
                                            </a>

                                            @if ($heads)
                                                @foreach ($heads as $head)
                                                    <div class="mb-4">
                                                        @if ($head->heads_cat == 1)
                                                            <div>
                                                                <h5>Руководитель</h5>
                                                            </div>
                                                        @else
                                                            <div>
                                                                <h5>Заместитель руководителя</h5>
                                                            </div>
                                                        @endif
                                                        <div>
                                                            <b>ФИО:</b>
                                                            {{ $head->heads_first_name }}
                                                            {{ $head->heads_second_name }}
                                                            {{ $head->heads_last_name }}
                                                        </div>
                                                        <div><b>Телефон:</b> {{ $head->heads_phone }}</div>
                                                        <div><b>Email:</b> {{ $head->heads_mail }}</div>
                                                        <div class="d-flex">
                                                            @if ($head->heads_fb)
                                                                <div class="mr-2">
                                                                    <a target="_blank"
                                                                        href="//{{ $head->heads_fb }}">Facebook</a>
                                                                </div>
                                                            @endif
                                                            @if ($head->heads_insta)
                                                                <div class="mr-2">
                                                                    <a target="_blank"
                                                                        href="//{{ $head->heads_insta }}">Instagram</a>
                                                                </div>
                                                            @endif
                                                            @if ($head->heads_vk)
                                                                <div class="mr-2">
                                                                    <a target="_blank"
                                                                        href="//{{ $head->heads_vk }}">VKontakte</a>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="d-flex align-items-baseline">

                                                            <a href="{{ route('head.edit', $head->heads_id) }}"
                                                                type="submit" class="btn btn-block btn-warning"
                                                                style="    max-width: 180px;">
                                                                <i class="fas fa-pencil-alt mr-2"></i>
                                                                Редактировать
                                                            </a>
                                                            <form class="ml-4" method="POST"
                                                                action="{{ route('head.destroy', $head->heads_id) }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-block btn-danger delete-btn"
                                                                    style="    max-width: 180px;">
                                                                    <i class="fas fa-trash mr-2"></i>
                                                                    Удалить
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                Руководители не внесены
                                            @endif


                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="card-header pl-0" style="    border: none;">
                                        <h4 class="card-title w-100">
                                            <a class="d-block w-100" data-toggle="collapse" href="#collapse9">
                                                Рейтинг компании и членство в ассоциациях
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapse9" class="collapse" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="mb-4">
                                                @foreach ($badges as $badge)
                                                    @foreach ($company_badges_array as $array)
                                                        @if ($badge->id == $array)
                                                            <img src="{{ $badge['img'] }}"
                                                                @if ($company_badges_array_desc != null) @foreach ($company_badges_array_desc as $key => $value)
                                                                @if ($badge->id == $key)
                                                                    title="{{ $value }}" @endif
                                                                @endforeach
                                                        @else
                                                            title="{{ $badge['description'] }}"
                                                        @endif
                                                        data-bs-toggle="tooltip" data-bs-html="true"
                                                        style="max-width: 20px; margin: 0 10px 0 0; max-height: 20px;" />
                                                    @endif
                                                @endforeach
                                                @endforeach
                                            </div>
                                            @if ($company_badges_blacklist)
                                                <div class="mb-3">
                                                    <b>В черном списке 789</b>
                                                </div>
                                            @endif

                                            @if ($company_badges_rik_now)
                                                <div class="form-group d-flex align-items-baseline mb-3">
                                                    <b class="pr-3">Рейтинг РИК текущий (оцениваемый): </b>
                                                    {{ $company_badges_rik_now }}
                                                </div>
                                            @endif



                                            @if ($company_badges_rik_middle)
                                                <div class="form-group d-flex align-items-baseline mb-3">
                                                    <b class="pr-3">Средний рейтинг РИК (оцениваемый): </b>
                                                    {{ $company_badges_rik_middle }}
                                                </div>
                                            @endif




                                            @if ($company_badges_rik_member)
                                                <div class="mb-3">
                                                    <b>Участник РИК (оценивает)</b>
                                                </div>
                                            @endif

                                            <a href="{{ route('companyBadges.edit', $company['id']) }}"
                                                class="btn btn-block btn-warning mb-2">
                                                <i class="fas fa-pencil-alt mr-2"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="card-header pl-0" style="    border: none;">
                                        <h4 class="card-title w-100">
                                            <a class="d-block w-100" data-toggle="collapse" href="#collapse8">
                                                Баннер с рекламой
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapse8" class="collapse" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="">
                                                <b>Баннер компании:</b><br>
                                                @if ($banner)
                                                    <img class="mb-4"
                                                        style="max-width: 300px; max-height: 200px;"
                                                        src="/storage/{{ $banner->company_banner_name }}" alt="">
                                                    <form class="" method="POST"
                                                        action="{{ route('companyBanner.destroy', $banner->company_banner_id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class=" mb-4 btn btn-block btn-danger delete-btn"
                                                            style="    max-width: 180px;">
                                                            <i class="fas fa-trash mr-2"></i>
                                                            Удалить баннер
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                            <a href="{{ route('companyBanner.edit', $company['id']) }}"
                                                class="btn btn-block btn-warning mb-2 d-flex"
                                                style="max-width: 340px;  align-items: center;">
                                                <i class="fas fa-pencil-alt mr-2"></i>
                                                Редактировать баннер компании
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="">
                                    <div class="card-header pl-0" style="    border: none;">
                                        <h4 class="card-title w-100">
                                            <a class="d-block w-100" data-toggle="collapse" href="#collapse11">
                                                Отзывы - рекомендации
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapse11" class="collapse" data-parent="#accordion">
                                        <div class="card-body">
                                            <a href="{{ route('companyFile.create', ['company' => $company['id'], 'file_cat' => 2]) }}"
                                                type="submit" class="btn btn-block btn-success"
                                                style=" margin-bottom: 20px;   max-width: 280px; margin-right: auto;"
                                                class="d-block mb-4">
                                                <i class="fas fa-plus mr-2"></i>
                                                Добавить отзыв
                                            </a>

                                            @foreach ($presentationFiles as $pf)
                                                @if ($pf->category == 2)
                                                    <a target="_blank" class="mr-4"
                                                        href="/storage/{{ $pf->file }}">{{ $pf->title }}
                                                    </a>
                                                    <div class="d-flex align-items-baseline mb-4 ">
                                                        <a href="/administrator/companyFile/{{ $pf->id }}/edit"
                                                            class="btn btn-block btn-warning mr-4"
                                                            style="    max-width: 180px;">
                                                            <i class="fas fa-pencil-alt mr-2"></i>
                                                            Редактировать
                                                        </a>
                                                        <form class="mr-4" method="POST"
                                                            action="{{ route('companyFile.destroy', $pf->id) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-block btn-danger delete-btn"
                                                                style="    max-width: 180px;">
                                                                <i class="fas fa-trash mr-2"></i>
                                                                Удалить файл
                                                            </button>
                                                        </form>

                                                    </div>

                                                    <a style="color: #000;" target="_blank"
                                                        href="/storage/{{ $pf->file }}">

                                                    </a>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <form method="POST" action="{{ route('company.destroy', $company['id']) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-block btn-danger delete-btn"
                                        style="    max-width: 180px; margin-left: auto;">
                                        <i class="fas fa-trash mr-2"></i>
                                        Удалить
                                    </button>
                                </form>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
@endsection

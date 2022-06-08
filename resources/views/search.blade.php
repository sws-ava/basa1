@extends('layouts/main_layout')


@section('title', 'О компании')


@section('content')

    <main class="main catalog">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="searchBlockHolder" style="background-image: url(/images/bg_search.jpg) " ;>
                        <div class="searchBlock">
                            <div class="title">
                                Поиск по базе
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="searchOpen greenBtn mt-2" style="max-width: 100px; margin-left: auto;">
                        Поиск
                    </div>
                    <div class="searchTabsHolder">
                        <ul class="nav nav-pills" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                                    aria-selected="true">Поиск</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                                    aria-selected="false">Расширенный поиск</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                aria-labelledby="pills-home-tab">
                                <form class="defaultSearchForm" action="">
                                    <div class="defaultSearchHolder" style="    padding-bottom: 2px;">
                                        <div class=" d-flex flex-column flex-lg-row  mb-2">
                                            <div class="inputHolder">
                                                <img class="searchImg" src="/images/search.svg" alt="">
                                                <input type="text" name="defaultSearchInput" id="defaultSearchInput"
                                                    placeholder="Введите город, область или название компании">
                                            </div>
                                            <div class="btnsHolder ml-auto d-flex mt-2 mt-lg-0">
                                                <button type="submit" class="greenBtn">
                                                    Поиск
                                                </button>
                                                <a href="#" class="blueBtn">
                                                    Поиск по карте
                                                </a>
                                            </div>
                                        </div>
                                        <div class="resultHolder">
                                            <div class="searchListHolder">
                                                <ul class="searchListHolderCompanies">
                                                </ul>
                                                <ul class="searchListHolderСities">
                                                </ul>
                                                <ul class="searchListHolderRegions">
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>
                            <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                                aria-labelledby="pills-profile-tab">
                                <div class="advSearchHolder">
                                    <img class="closeAdvSearch d-none" src="/images/chipx.svg">
                                    <form class="advSearchForm">
                                        <div class="iHolder w50">
                                            <label for="">
                                                По области
                                            </label>
                                            <select class="select2" name="district_id" id="">
                                                <option value="0">Выберите регион</option>
                                                @foreach ($regions as $region)
                                                    <option value="{{ $region->id }}">{{ $region->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="iHolder w50">
                                            <label for="">
                                                По городу
                                            </label>
                                            <select class="select2" name="city_id" id="">
                                                <option value="0">Выберите город</option>
                                                @foreach ($cities as $city)
                                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                                @endforeach
                                                <option value="">Введите или выберите город</option>
                                            </select>
                                        </div>
                                        <div class="iHolder w33">
                                            <label for="">
                                                По названию
                                            </label>
                                            <input name="name" type="text" placeholder="Введите название компании">
                                        </div>
                                        <div class="iHolder w33">
                                            <label for="">
                                                По руководителю
                                            </label>
                                            <input name="head" type="text" placeholder="Введите имя руководителя">
                                        </div>
                                        <div class="iHolder w33">
                                            <label for="">
                                                По ОГРН или ИНН
                                            </label>
                                            <input name="ogrn" type="text" placeholder="Введите ОГРН или ИНН">
                                        </div>
                                        <div class="iHolder w100">
                                            <label for="">
                                                По описанию
                                            </label>
                                            <input name="text" type="text" placeholder="Введите ОГРН или ИНН">
                                        </div>
                                        <div class="w100 checkboxHolder">
                                            <div class="iHolder checkbox">
                                                <input name="cati" id="cati" type="checkbox" value="1">
                                                <label for="cati">
                                                    Наличие CATI-студий
                                                </label>
                                            </div>
                                            <div class="iHolder checkbox">
                                                <input name="online" id="pannels" type="checkbox" value="1">
                                                <label for="pannels">
                                                    Наличие онлайн-панелей
                                                </label>
                                            </div>
                                            <div class="iHolder checkbox">
                                                <input name="focus" id="focus" type="checkbox" value="1">
                                                <label for="focus">
                                                    Фокус-комната
                                                </label>
                                            </div>
                                        </div>
                                        <div class="btnsHolder ml-auto d-flex ">
                                            <button type="submit" class="greenBtn">
                                                Поиск
                                            </button>
                                            <a href="#" class="blueBtn">
                                                Поиск по карте
                                            </a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="chips">
                        <div class="chipsHolder">
                            <div class="chipsTitle">
                                Выбраны фильтры: <a href="/" class="delFilters">Сбросить фильтры</a>
                            </div>
                            <div class="chipsItems">
                                <div class="chipsItem">
                                    Московская область
                                    <div class="imgHolder">
                                        <img src="/images/chipx.svg" alt="">
                                    </div>
                                </div>
                                <div class="chipsItem">
                                    Москва
                                    <div class="imgHolder">
                                        <img src="/images/chipx.svg" alt="">
                                    </div>
                                </div>
                                <div class="chipsItem">
                                    Московская область
                                    <div class="imgHolder">
                                        <img src="/images/chipx.svg" alt="">
                                    </div>
                                </div>
                                <div class="chipsItem">
                                    Московская область
                                    <div class="imgHolder">
                                        <img src="/images/chipx.svg" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 mb-4">
                    <div class="pageTitle">
                        Каталог компаний
                    </div>
                </div>
                <div class="col-12 col-lg-6 mb-4 text-right d-none">
                    <div class="sortType">
                        Сортировка:
                        <select class="brandSelect sortTypeSelect" name="sortType" id="">
                            <option value="1">По рейтингу</option>
                            <option value="1">По рейтингу</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row d-none">
                <div class="col-12 col-lg-6 mb-4">
                    <div class="pageTitle">
                        Каталог компаний
                    </div>
                </div>
                <div class="col-12 col-lg-6 mb-4 text-right">
                    <div class="sortType d-none">
                        Сортировка:
                        <select class="brandSelect sortTypeSelect" name="sortType" id="">
                            <option value="1">По рейтингу</option>
                            <option value="1">По рейтингу</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12  mb-4">
                    <div id="catalog">

                        @empty($companies->count() < 1)
                            @foreach ($companies as $company)
                                <div
                                    class="catalogItem
                            @if ($company->isTop == 1) top @endif
                            ">
                                    <div class=" row">
                                        <div class="col-12 col-lg-6">


                                            <style>
                                                .starsHolder {
                                                    font-size: 26px;
                                                    letter-spacing: -1px;
                                                    text-transform: uppercase;
                                                    background: #F2D056;
                                                    -webkit-background-clip: text;
                                                    background-clip: text;
                                                    -webkit-text-fill-color: transparent;
                                                    color: #0B2349;
                                                    -webkit-text-stroke: 0.5px #F2D056;
                                                }

                                            </style>

                                            <div class="stars">


                                                {{-- @foreach ($company_badges as $company_badge)
                                                    @if ($company_badge->company_badges_company_id == $company->id)
                                                        рейтинг
                                                    @endif
                                                @endforeach --}}

                                                @if ($company->raiting)
                                                    @php
                                                        $progress = (100 / 5) * $company->raiting;
                                                    @endphp
                                                    <div class="starsHolder" style="width: {{ $progress }}%;">

                                                        ★★★★★
                                                    </div>
                                                @else
                                                    <div class="starsHolder" style="width:0%;">

                                                        ★★★★★
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="title d-flex flex-column flex-lg-row">
                                                <a class="me-2 mb-2 mb-lg-1" href="/company/{{ $company->id }}"
                                                    style="color: #2F4E54;">{{ $company->id }} {{ $company->name }}</a>


                                                @php
                                                    $badgesArray = explode(',', str_replace(['[', ']', '"'], ['', '', ''], $company->badges_array));
                                                @endphp
                                                <div class="badgesRow d-flex align-items-start mb-2 mb-lg-0">
                                                    @foreach ($badgesArray as $ba)
                                                        @foreach ($badges as $badge)
                                                            @if ($ba == $badge->id)
                                                                <div class="me-2" data-bs-toggle="tooltip"
                                                                    data-bs-html="true" title=""
                                                                    @foreach (json_decode($company->badges_array_descs) as $key => $bad) @if ($ba == $key)
                                                                    data-bs-original-title="{{ $bad }}" @endif @endforeach>
                                                                    <img src="{{ $badge->img }}" alt=""
                                                                        style="max-width: 25px; max-height: 25px; ">
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                </div>









                                            </div>
                                            <div class="geo">
                                                @foreach ($regions as $region)
                                                    @if ($region->id == $company->district_id)
                                                        {{ $region->name }},
                                                    @endif
                                                @endforeach
                                                <br>
                                                @foreach ($cities as $city)
                                                    @if ($city->id == $company->city_id)
                                                        {{ $city->name }}
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-3">
                                            <div class="info">
                                                <div class="infoBlock">
                                                    <span>Телефон</span>
                                                    <a href="tel:{{ $company->phone }}">{{ $company->phone }}</a>
                                                </div>
                                                <div class="infoBlock">

                                                    @foreach ($heads as $head)
                                                        @if ($company->id == $head->heads_company_id)
                                                            @if ($head->heads_cat == 1)
                                                                <span>Руководитель</span>
                                                                {{ $head->heads_first_name }}
                                                                {{ $head->heads_second_name }}
                                                                {{ $head->heads_last_name }}
                                                            @else
                                                                <div class="mt-3">
                                                                    <span>Заместитель руководителя</span>
                                                                    {{ $head->heads_first_name }}
                                                                    {{ $head->heads_second_name }}
                                                                    {{ $head->heads_last_name }}
                                                                </div>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-3">
                                            <div class="info">
                                                <div class="infoBlock">
                                                    @if ($company->email)
                                                        <span>Почта</span>
                                                        <a href="mailto:{{ $company->email }}">{{ $company->email }}</a>
                                                    @endif
                                                </div>
                                                <div class="infoBlock">

                                                    @if ($company->site)
                                                        <span>Сайт</span>
                                                        <a target="_blank"
                                                            href="//{{ $company->site }}">{{ $company->site }}</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            Ничего не найдено
                        @endempty
                    </div>
                    {{ $companies->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </main>


    </div>
@endsection

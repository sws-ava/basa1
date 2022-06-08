@extends('layouts/main_layout')


@section('title', 'Атлас')


@section('content')

    <style>
        .catalog .catalogItem .title a:hover {
            text-decoration: underline;
        }

        .greenBtn:hover {
            background: #bdd40c;
            transition: all 0.25s ease-in;
        }

        .closeSearchBlock {
            position: absolute;
            right: 0px;
            top: -10px;
            cursor: pointer;
        }

        .chips .chipsHolder .chipsTitle .delFilters:hover {
            color: #125d6a;
            transition: all 0.25s ease-in;
        }

        .chips .chipsHolder .chipsItems .chipsItem:hover {
            background: #97d3e2;
        }


        /* select2-container select2-container--default select2-container--open .select2-container.select2-container--default.select2-container--open {
                                                                                                                                                                                        display: none;
                                                                                                                                                                                        border: none !important;
                                                                                                                                                                                    } */

        .resultHolder {
            overflow-y: scroll;
            max-height: 400px;
            margin: 0 -22px;
        }

        .resultHolder::-webkit-scrollbar {
            width: 3px;
            background: transparent;
        }


        .resultHolder::-webkit-scrollbar-track {
            box-shadow: none;
        }

        .resultHolder::-webkit-scrollbar-thumb {
            background-color: #25b1cc;
            outline: 1px solid transparent;
            border-radius: 2px;
        }

        .searchListHolder ul li {
            padding: 10px 22px;
            margin: 0;
            width: 100%;
        }

        .searchListHolder ul {
            margin-left: 0px;
            margin-right: 0px;
        }

        .defaultSearchHolder .inputHolder {
            width: 100%;
        }

        .resultHolder a {
            display: block;
        }

        .searchListHolder ul li a {
            padding: 10px 0;
        }

    </style>

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
                                                <input type="text" name="name" id="defaultSearchInput"
                                                    placeholder="Введите город, область или название компании">
                                            </div>
                                            <div class="btnsHolder ml-auto d-flex mt-2 mt-lg-0">
                                                <button type="submit" class="greenBtn">
                                                    Поиск
                                                </button>
                                                <a href="#" class="blueBtn d-none">
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
                                                <ul class="searchListHolderWorkСities">
                                                </ul>
                                                <ul class="searchListHolderWorkRegions">
                                                </ul>
                                                <ul class="searchListHolderRegions">
                                                </ul>
                                                <ul class="searchListHolderHeads">
                                                </ul>
                                                <ul class="searchListHolderField_works">
                                                </ul>
                                                <ul class="searchListHolderRes_solutions">
                                                </ul>
                                                <ul class="searchListHolderSpec">
                                                </ul>
                                                <ul class="searchListHolderResources">
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
                                    <form class="advSearchForm pt-2" style="position:relative;">
                                        <div class="closeSearchBlock">
                                            <img src="/images/closeModal.svg" alt="">
                                        </div>
                                        <div class="iHolder w50">
                                            <label for="">
                                                По области
                                            </label>
                                            <select class="select2" name="district_id" id="" style="width: 100%;">
                                                <option value="0">Выберите регион</option>
                                                @foreach ($regions as $region)
                                                    <option value="{{ $region->id }}"
                                                        @if (isset($_GET['district_id'])) @if ($_GET['district_id'] == $region->id) selected @endif
                                                        @endif>{{ $region->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="iHolder w50">
                                            <label for="">
                                                По городу
                                            </label>
                                            <select class="select2" name="city_id" id="" style="width: 100%;">
                                                <option value="0">Выберите город</option>
                                                @foreach ($cities as $city)
                                                    <option
                                                        @if (isset($_GET['work_cities'])) @if ($_GET['work_cities'] == $city->id) selected @endif
                                                        @endif value="{{ $city->id }}">{{ $city->name }}</option>
                                                @endforeach
                                                <option value="">Введите или выберите город</option>
                                            </select>
                                        </div>
                                        <div class="iHolder w33">
                                            <label for="">
                                                По названию
                                            </label>
                                            <input name="name"
                                                @if (isset($_GET['name'])) value="{{ $_GET['name'] }}" @endif
                                                type="text" placeholder="Введите название компании">
                                        </div>
                                        <div class="iHolder w33">
                                            <label for="">
                                                По ИНН
                                            </label>
                                            <input @if (isset($_GET['inn'])) value="{{ $_GET['inn'] }}" @endif
                                                name="inn" type="text" placeholder="Введите ИНН">
                                        </div>
                                        <div class="iHolder w33">
                                            <label for="">
                                                По ОГРН
                                            </label>
                                            <input @if (isset($_GET['ogrn'])) value="{{ $_GET['ogrn'] }}" @endif
                                                name="ogrn" type="text" placeholder="Введите ОГРН">
                                        </div>
                                        <div class="iHolder w100 d-none">
                                            <label for="">
                                                По описанию
                                            </label>
                                            <input @if (isset($_GET['text'])) value="{{ $_GET['text'] }}" @endif
                                                name="text" type="text" placeholder="Введите текст">
                                        </div>
                                        <div class="w100 checkboxHolder">
                                            <div class="iHolder checkbox">
                                                <input @if (isset($_GET['cati'])) checked @endif name="cati"
                                                    id="cati" type="checkbox" value="1">
                                                <label for="cati">
                                                    Наличие CATI-студий
                                                </label>
                                            </div>
                                            <div class="iHolder checkbox">
                                                <input @if (isset($_GET['online'])) checked @endif name="online"
                                                    id="pannels" type="checkbox" value="1">
                                                <label for="pannels">
                                                    Наличие онлайн-панелей
                                                </label>
                                            </div>
                                            <div class="iHolder checkbox">
                                                <input @if (isset($_GET['focus'])) checked @endif name="focus"
                                                    id="focus" type="checkbox" value="1">
                                                <label for="focus">
                                                    Фокус-комната
                                                </label>
                                            </div>
                                        </div>
                                        <div class="btnsHolder ml-auto d-flex ">
                                            <button type="submit" class="greenBtn">
                                                Поиск
                                            </button>
                                            <a href="#" class="blueBtn  d-none">
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
                            @if (isset($_GET['district_id']) || isset($_GET['city_id']))
                                <div class="chipsTitle">
                                    Выбраны фильтры: <a href="/" class="delFilters">Сбросить фильтры</a>
                                </div>
                            @endif
                            <div class="chipsItems">
                                @if (isset($_GET['district_id']))
                                    @foreach ($regions as $region)
                                        @if ($_GET['district_id'] == $region->id)
                                            <div class="chipsItem">
                                                {{ $region->name }}
                                                <div class="imgHolder delFilterItem" param="district_id">
                                                    <img src="/images/chipx.svg" alt="">
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                                @if (isset($_GET['city_id']))
                                    @php
                                        $array = explode(',', $_GET['city_id']);
                                    @endphp
                                    @foreach ($array as $row)
                                        @foreach ($cities as $city)
                                            @if ($row == $city->id)
                                                <div class="chipsItem">
                                                    {{ $city->name }}
                                                    <div class="imgHolder delFilterItem"
                                                        param="city_id---{{ $city->id }}">
                                                        <img src="/images/chipx.svg" alt="">
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endforeach
                                @endif


                                @if (isset($_GET['work_cities']))
                                    @php
                                        $array = explode(',', $_GET['work_cities']);
                                    @endphp
                                    @foreach ($array as $row)
                                        @foreach ($cities as $city)
                                            @if ($row == $city->id)
                                                <div class="chipsItem">
                                                    {{ $city->name }}
                                                    <div class="imgHolder delFilterItem"
                                                        param="work_cities---{{ $city->id }}">
                                                        <img src="/images/chipx.svg" alt="">
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endforeach
                                @endif


                                @if (isset($_GET['work_regions']))
                                    @php
                                        $array = explode(',', $_GET['work_regions']);
                                    @endphp
                                    @foreach ($array as $row)
                                        @foreach ($regions as $region)
                                            @if ($row == $region->id)
                                                <div class="chipsItem">
                                                    {{ $region->name }}
                                                    <div class="imgHolder delFilterItem"
                                                        param="work_regions---{{ $region->id }}">
                                                        <img src="/images/chipx.svg" alt="">
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endforeach
                                @endif



                                @if (isset($_GET['field_works']))
                                    @php
                                        $array = explode(',', $_GET['field_works']);
                                    @endphp
                                    @foreach ($array as $row)
                                        @foreach ($field_works_items as $item)
                                            @if ($row == $item->field_works_item_id)
                                                <div class="chipsItem">
                                                    {{ $item->field_works_item_name }}
                                                    <div class="imgHolder delFilterItem"
                                                        param="field_works---{{ $item->field_works_item_id }}">
                                                        <img src="/images/chipx.svg" alt="">
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endforeach
                                @endif
                                @if (isset($_GET['res_solutions']))
                                    @php
                                        $array = explode(',', $_GET['res_solutions']);
                                    @endphp
                                    @foreach ($array as $row)
                                        @foreach ($research_solutions_items as $item)
                                            @if ($row == $item->research_solutions_items_id)
                                                <div class="chipsItem">
                                                    {{ $item->research_solutions_items_name }}
                                                    <div class="imgHolder delFilterItem"
                                                        param="res_solutions---{{ $item->research_solutions_items_id }}">
                                                        <img src="/images/chipx.svg" alt="">
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endforeach
                                @endif
                                @if (isset($_GET['spec']))
                                    @php
                                        $array = explode(',', $_GET['spec']);
                                    @endphp
                                    @foreach ($array as $row)
                                        @foreach ($spec_works_items as $item)
                                            @if ($row == $item->spec_item_id)
                                                <div class="chipsItem">
                                                    {{ $item->spec_item_name }}
                                                    <div class="imgHolder delFilterItem"
                                                        param="spec---{{ $item->spec_item_id }}">
                                                        <img src="/images/chipx.svg" alt="">
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endforeach
                                @endif
                                @if (isset($_GET['resources']))
                                    @php
                                        $array = explode(',', $_GET['resources']);
                                    @endphp
                                    @foreach ($array as $row)
                                        @foreach ($resources_items as $item)
                                            @if ($row == $item->resources_items_id)
                                                <div class="chipsItem">
                                                    {{ $item->resources_items_name }}
                                                    <div class="imgHolder delFilterItem"
                                                        param="resources---{{ $item->resources_items_id }}">
                                                        <img src="/images/chipx.svg" alt="">
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endforeach
                                @endif












                                @if (isset($_GET['name']))
                                    @if ($_GET['name'] != '')
                                        <div class="chipsItem">
                                            Название: {{ $_GET['name'] }}
                                            <div class="imgHolder delFilterItem" param="name">
                                                <img src="/images/chipx.svg" alt="">
                                            </div>
                                        </div>
                                    @endif
                                @endif
                                @if (isset($_GET['inn']))
                                    @if ($_GET['inn'] != '')
                                        <div class="chipsItem">
                                            Инн: {{ $_GET['inn'] }}
                                            <div class="imgHolder delFilterItem" param="inn">
                                                <img src="/images/chipx.svg" alt="">
                                            </div>
                                        </div>
                                    @endif
                                @endif
                                @if (isset($_GET['ogrn']))
                                    @if ($_GET['ogrn'] != '')
                                        <div class="chipsItem">
                                            ОГРН: {{ $_GET['ogrn'] }}
                                            <div class="imgHolder delFilterItem" param="ogrn">
                                                <img src="/images/chipx.svg" alt="">
                                            </div>
                                        </div>
                                    @endif
                                @endif
                                @if (isset($_GET['text']))
                                    @if ($_GET['text'] != '')
                                        <div class="chipsItem">
                                            Текст: {{ $_GET['text'] }}
                                            <div class="imgHolder delFilterItem" param="text">
                                                <img src="/images/chipx.svg" alt="">
                                            </div>
                                        </div>
                                    @endif
                                @endif
                                @if (isset($_GET['cati']))
                                    <div class="chipsItem">
                                        Наличие CATI-студий
                                        <div class="imgHolder delFilterItem" param="cati">
                                            <img src="/images/chipx.svg" alt="">
                                        </div>
                                    </div>
                                @endif
                                @if (isset($_GET['online']))
                                    <div class="chipsItem">
                                        Наличие онлайн-панелей
                                        <div class="imgHolder delFilterItem" param="online">
                                            <img src="/images/chipx.svg" alt="">
                                        </div>
                                    </div>
                                @endif
                                @if (isset($_GET['focus']))
                                    <div class="chipsItem">
                                        Фокус-комната
                                        <div class="imgHolder delFilterItem" param="focus">
                                            <img src="/images/chipx.svg" alt="">
                                        </div>
                                    </div>
                                @endif


                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 mb-4">
                    <div class="pageTitle">
                        Каталог компаний
                    </div>
                </div>
                {{-- <div class="col-12 col-lg-6 mb-4 text-right d-none">
                    <div class="sortType">
                        Сортировка:
                        <select class="brandSelect sortTypeSelect" name="sortType" id="">
                            <option value="1">По рейтингу</option>
                            <option value="1">По рейтингу</option>
                        </select>
                    </div>
                </div> --}}
            </div>

            <style>
                .member {
                    border: 1px solid #abe1ec !important;
                    background: #f0fff4;
                }

            </style>

            <div class="row">
                <div class="col-12  mb-4">
                    <div id="catalog">

                        @empty($companies->count() < 1)
                            @foreach ($companies as $company)
                                <div
                                    class="catalogItem
                            @if ($company->sort_num >= 90 && $company->sort_num < 500) top
                            @elseif ($company->sort_num >= 80 && $company->sort_num < 90) member @endif ">
                                    <div class="    row">
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

                                            <div class="stars d-none">


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
                                            <div class="
                                    title d-flex flex-column">
                                                <a class="me-2 mb-2 mb-lg-1" href="/company/{{ $company->id }}"
                                                    style="color: #2F4E54;">
                                                    {{-- {{ $company->id }} --}}
                                                    {{ $company->name }}</a>


                                                @php
                                                    $badgesArray = explode(',', str_replace(['[', ']', '"'], ['', '', ''], $company->badges_array));
                                                @endphp
                                                <div class="badgesRow d-flex align-items-start mb-2 mt-2">
                                                    @foreach ($badgesArray as $ba)
                                                        @foreach ($badges as $badge)
                                                            @if ($ba == $badge->id)
                                                                <div class="me-2" data-bs-toggle="tooltip"
                                                                    data-bs-html="true" title=""
                                                                    @foreach (json_decode($company->badges_array_descs) as $key => $bad) @if ($ba == $key)
                                                                    data-bs-original-title="{{ $bad }}" @endif
                                                                    @endforeach>
                                                                    <img src="{{ $badge->img }}" alt=""
                                                                        style="max-width: 25px; max-height: 25px; width:100%; ">
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
                                                @if ($company->phone)
                                                    <div class="infoBlock">
                                                        <span>Телефон</span>
                                                        <a href="tel:{{ $company->phone }}">{{ $company->phone }}</a>
                                                    </div>
                                                @endif

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
                    {{ $companies->withQueryString()->onEachSide(0)->links() }}

                </div>
                <div class="col-12 mb-4 text-center">
                    <a class="me-4" href="/about">Про Атлас</a>
                    <a href="/badges">Описание значков</a>
                </div>
            </div>
        </div>
    </main>


    </div>
@endsection

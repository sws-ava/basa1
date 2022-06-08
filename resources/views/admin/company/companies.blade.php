@extends('layouts/admin_layout')


@section('title', 'Все компании')


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Все компании</h1>
            </div>
        </div>


        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body table-responsive p-0">
                    </div>
                </div>
            </div>
        </div>


        <style>
            .chips .chipsHolder .chipsTitle {
                margin-bottom: 10px;
            }

            .chips .chipsHolder .chipsTitle .delFilters {
                color: #32BDD6;
                cursor: pointer;
            }

            .chips .chipsHolder .chipsItems {
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                -ms-flex-wrap: wrap;
                flex-wrap: wrap;
            }

            .chips .chipsHolder .chipsItems .chipsItem {
                background: #E8F4F7;
                border-radius: 5px;
                padding: 4px 10px;
                margin-right: 10px;
                margin-bottom: 10px;
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                -webkit-box-align: center;
                -ms-flex-align: center;
                align-items: center;
                font-weight: 500;
            }

            .chips .chipsHolder .chipsItems .chipsItem .imgHolder {
                display: block;
                padding: 10px 0 10px 10px;
                cursor: pointer;
            }
        </style>





        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Поиск компании</label>
                            <input type="text" class="form-control" id="company_query"
                                placeholder="Поиск компании (минимум 3 символа)">
                        </div>
                        {{-- <table class="table searchList">

                        </table> --}}


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

                        <a href="/administrator/all_companies">Сбросить фильтр</a>
                    </div>

                </div>
            </div>


            <div class="col-12">
            </div>



        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap companiesTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th style="    width: 100%;">Название</th>
                                    {{-- <th>Описание</th> --}}
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="companiesTableTbody">
                                @foreach ($companies as $company)
                                    <tr>
                                        <td> {{ $company['id'] }}</td>
                                        <td> {{ $company['name'] }}</td>
                                        <td>
                                            @if ($company['show'] == 0)
                                                <div class="d-flex align-items-center justify-content-end">
                                                    <span class="mr-4" style="color: red; font-weight: 700;">Не
                                                        показывается</span>
                                                    <form method="POST" action="{{ route('show', $company['id']) }}">
                                                        @csrf
                                                        <input type="text" hidden name="company_id"
                                                            value="{{ $company['id'] }}">
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
                                                        <input type="text" hidden name="company_id"
                                                            value="{{ $company['id'] }}">
                                                        <input type="text" hidden name="show" value="0">
                                                        <button type="submit" class="btn btn-block btn-danger"
                                                            style="    max-width: 180px; margin-left: auto;">
                                                            Выключить
                                                        </button>
                                                    </form>
                                                </div>
                                            @endif
                                        </td>
                                        {{-- <td> {{ $company['short'] }}</td> --}}
                                        <td>
                                        <td>
                                            <a href="{{ route('company.show', $company['id']) }}"
                                                class="btn btn-block btn-warning" style="    max-width: 190px;">
                                                <i class="fas fa-pencil-alt mr-2"></i>
                                                Редактировать
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mb-4">
                            {{ $companies->withQueryString()->links() }}
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>

    @endsection

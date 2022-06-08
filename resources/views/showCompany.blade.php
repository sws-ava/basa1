@extends('layouts/main_layout')


@section('title', "Компания $company->name")


@section('content')


    <style>
        .companyPage__tabsLink,
        /* .companyPage__tabsLi, */
        .tabsContHolder__title_accordion {
            -webkit-appearance: none;
        }

        .companyPage__tabsLink {
            /* height: 38px; */
            display: block;
        }

        .companyDetails .title {
            font-size: 20px;
        }

        li b {
            font-weight: 500;
        }


        li.title::before,
        li.photos::before {
            display: none;
        }

        li {
            list-style: none;
        }

        li.title {
            padding-left: 0;
            font-size: 16px !important;
        }

        li.photos {
            padding-left: 0 !important;
        }

        div.accordion-button::after {
            flex-shrink: 0;
            width: 1.25rem;
            height: 1.25rem;
            margin-left: auto;
            content: "";
            background-image: url(data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23212529'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e);
            background-repeat: no-repeat;
            background-size: 1.25rem;
            transition: transform .2s ease-in-out;
        }

        div.accordion-button:not(.collapsed)::after {
            background-image: url(data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%230c63e4'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e);
            transform: rotate(-180deg);
        }

        .accordion-button:not(.collapsed) {
            background-color: transparent !important;
            box-shadow: none !important;
        }

        .itemsList {
            padding-left: 0;
            padding-right: 5px;
        }

        .subLi li:not(.title) {
            /* margin-left: 30px !important; */
        }

        .company .separator {
            border: none;
        }

        .badgeItem {
            background: #fff;
            padding: 5px;
            border-radius: 50%;
            width: 30px;
            height: 30px;
        }

        .photos .slick-initialized .slick-slide {
            height: 150px;
            padding: 0 10px;
        }

        .photos .slick-slide a {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            overflow: hidden;
        }

        .photos .slick-slide img {
            object-fit: cover !important;
        }

    </style>


    <style>
        .slick-slide {
            margin: 0px 20px;
        }

        .slick-slide img {
            width: 100%;
            max-height: 280px;
            object-fit: contain;
        }

        .slick-prev:before,
        .slick-next:before {
            color: black;
        }

        .slick-lightbox-slick-img {
            max-height: 700px !important;
            width: auto !important;
        }

    </style>




    <main class="main">
        <div class="container companyPage">
            <div class="row">


                <div class="col-12 ">
                    <div class="company">
                        <a class="breadCrumbs" href="/">
                            <img src="/images/backArrow.svg" alt=""> Назад к списку компаний
                        </a>
                    </div>



                    <div class="companyPage__status">
                        <span>Опубликовано</span>
                        <span>Последнее обновление:
                            @php
                                $upd_at_arr = explode('.', $company->updated_at);
                                $updated_at = $upd_at_arr[2] . '.' . $upd_at_arr[1] . '.' . $upd_at_arr[0];
                            @endphp

                            {{ $updated_at }}</span>
                    </div>
                    @if ($company->foundation)
                        <div class="companyPage__since">
                            Работает с {{ $company->foundation }} года
                        </div>
                    @endif
                    <div class="companyPage__title">
                        {{ $company->name }}
                    </div>
                    @if ($company->short)
                        <div class="companyPage__desc">
                            {{ $company->short }}
                        </div>
                    @endif
                    <div class="companyPage__badgesStarsHolder">
                        <div class="companyPage__badgesHolder">
                            @foreach ($badges as $badge)
                                @foreach ($company_badges_array as $array)
                                    @if ($badge->id == $array)
                                        <div class="companyPage__badge">
                                            <img src="{{ $badge['img'] }}" class="companyPage__badgeImg"
                                                data-bs-toggle="tooltip" data-bs-html="true"
                                                style="max-width: 20px; margin: 0 10px 0 0; max-height: 20px;"
                                                @if ($company_badges_array_desc != null) @foreach ($company_badges_array_desc as $key => $value)
                                                        @if ($badge->id == $key)
                                                        title="
                                                            @if ($value)
                                                            {{ $value }}
                                                            @else
                                                            {{ $badge['description'] }} @endif "


































                                                                         @endif
                                    @endforeach
                                @endif
                                />
                        </div>

                        @endif
                        @endforeach
                        @endforeach
                    </div>
                    {{-- <div class="companyPage__starsHolder">
                            <div class="companyPage__stars">
                                <div class="companyPage__starsLine" style="width:50%;">
                                    ★★★★★
                                </div>
                            </div>
                        </div> --}}
                </div>
            </div>
            <div class="col-12">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="companyPage__topInfoBlock">
                            <div class="companyPage__topInfoBlockTitle">
                                О компании
                            </div>
                            <p>
                                @if ($company->index)
                                    {{ $company->index }},
                                @endif
                                @foreach ($cities as $city)
                                    @if ($company->city_id == $city->id)
                                        {{ $city->name }}
                                    @endif
                                @endforeach
                                @if ($company->address)
                                    , {{ $company->address }}
                                @endif
                            </p>
                            @if ($company->site)
                                <a target="_blank" href="//{{ $company->site }}"
                                    class="companyPage__topInfoSite">{{ $company->site }}</a>
                            @endif

                            @if ($company->email)
                                <a href="mailto:{{ $company->email }}"
                                    class="companyPage__topInfoMail">{{ $company->email }}</a>
                            @endif

                            @if ($company->phone)
                                <a class="mt-3 companyPage__topInfoMail" href="tel:{{ $company->phone }}">
                                    {{ $company->phone }}
                                </a>
                            @endif



                            <div class="companyPage__topInfoBlockContacts">
                                {{-- @if ($company->phone)
                                    <div class="companyPage__topInfoBlockContact">
                                        <a href="tel:{{ $company->phone }}" class="companyPage__topInfoBlockContactLink">
                                            <img src="/images/social1/ph.svg" alt="">
                                        </a>
                                    </div>
                                @endif --}}
                                @if ($company->isTop)
                                    {{-- @if ($company->fb)
                                    <div class="companyPage__topInfoBlockContact">
                                        <a target="_blank" href="//{{ $company->fb }}  " class="companyPage__topInfoBlockContactLink"">
                                            <img src="/images/social1/fb.svg" alt="">
                                        </a>
                                    </div>
                                    @endif --}}
                                    @if ($company->tw)
                                        <div class="companyPage__topInfoBlockContact">
                                            <a target="_blank" href="//{{ $company->tw }} "
                                                class="companyPage__topInfoBlockContactLink">
                                                <img src="/images/social1/tw.svg" alt="">
                                            </a>
                                        </div>
                                    @endif
                                    @if ($company->tg)
                                        <div class="companyPage__topInfoBlockContact">
                                            <a target="_blank" href="//{{ $company->tg }}  "
                                                class="companyPage__topInfoBlockContactLink">
                                                <img src="/images/social1/vb.svg" alt="">
                                            </a>
                                        </div>
                                    @endif
                                    {{-- @if ($company->insta)
                                    <div class="companyPage__topInfoBlockContact">
                                        <a target="_blank" href="//{{ $company->insta }}  " class="companyPage__topInfoBlockContactLink"">
                                            <img src="/images/social1/in.svg" alt="">
                                        </a>
                                    </div>
                                    @endif --}}
                                    @if ($company->whatsup)
                                        <div class="companyPage__topInfoBlockContact">
                                            <a target="_blank" href="//{{ $company->whatsup }}  "
                                                class="companyPage__topInfoBlockContactLink">
                                                <img src="/images/social1/wu.svg" alt="">
                                            </a>
                                        </div>
                                    @endif
                                    @if ($company->vk)
                                        <div class="companyPage__topInfoBlockContact">
                                            <a target="_blank" href="//{{ $company->vk }}  "
                                                class="companyPage__topInfoBlockContactLink">
                                                <img src="/images/social1/vk.svg" alt="">
                                            </a>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>

                    @if ($heads)
                        <div class="col-lg-3">
                            <div class="companyPage__topInfoBlock">
                                @foreach ($heads as $head)
                                    @if ($company->id == $head->heads_company_id)
                                        @if ($head->heads_cat == 1)

                                            <div class="companyPage__topInfoBlockTitle">
                                                Руководитель
                                            </div>
                                        @else
                                            <div class="companyPage__topInfoBlockTitle mt-3">
                                                Заместитель руководителя
                                            </div>
                                        @endif
                                        <p>{{ $head->heads_first_name }} {{ $head->heads_second_name }}
                                            {{ $head->heads_last_name }}</p>
                                        {{-- @if ($company->isTop == 1)
                                            @if ($head->heads_mail)
                                                <a href="mailto:{{ $head->heads_mail }}"
                                                    class="companyPage__topInfoMail">{{ $head->heads_mail }}</a>
                                            @endif

                                            <div class="companyPage__topInfoBlockContacts">
                                                @if ($head->heads_phone)
                                                    <div class="companyPage__topInfoBlockContact">
                                                        <a href="tel:{{ $head->heads_phone }}"
                                                            class="companyPage__topInfoBlockContactLink">
                                                            <img src="/images/social/phone.svg" alt="">
                                                        </a>
                                                    </div>
                                                @endif
                                                @if ($head->heads_fb)
                                                <div class="companyPage__topInfoBlockContact">
                                                    <a target="_blank" href="//{{ $head->heads_fb }}"
                                                        class="companyPage__topInfoBlockContactLink">
                                                        <img src="/images/social/facebook.svg" alt="">
                                                    </a>
                                                </div>
                                            @endif
                                            @if ($head->heads_insta)
                                                <div class="companyPage__topInfoBlockContact">
                                                    <a target="_blank" href="//{{ $head->heads_insta }}"
                                                        class="companyPage__topInfoBlockContactLink">
                                                        <img src="/images/social/insta.svg" alt="">
                                                    </a>
                                                </div>
                                            @endif
                                                @if ($head->heads_vk)
                                                    <div class="companyPage__topInfoBlockContact">
                                                        <a target="_blank" href="//{{ $head->heads_vk }}"
                                                            class="companyPage__topInfoBlockContactLink">
                                                            <img src="/images/social/vk.svg" alt="">
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        @endif --}}
                                    @endif
                                @endforeach

                                <div class="companyPage__topInfoBlockContacts d-none">
                                    <div class="companyPage__topInfoBlockContact">
                                        <a href="" class="companyPage__topInfoBlockContactLink">
                                            <img src="/images/social1/ph.svg" alt="">
                                        </a>
                                    </div>
                                    <div class="companyPage__topInfoBlockContact">
                                        <a href="" class="companyPage__topInfoBlockContactLink">
                                            <img src="/images/social1/wu.svg" alt="">
                                        </a>
                                    </div>
                                    <div class="companyPage__topInfoBlockContact">
                                        <a href="" class="companyPage__topInfoBlockContactLink">
                                            <img src="/images/social1/vb.svg" alt="">
                                        </a>
                                    </div>
                                    <div class="companyPage__topInfoBlockContact">
                                        <a href="" class="companyPage__topInfoBlockContactLink">
                                            <img src="/images/social1/fb.svg" alt="">
                                        </a>
                                    </div>
                                    <div class="companyPage__topInfoBlockContact">
                                        <a href="" class="companyPage__topInfoBlockContactLink">
                                            <img src="/images/social1/vk.svg" alt="">
                                        </a>
                                    </div>
                                    <div class="companyPage__topInfoBlockContact">
                                        <a href="" class="companyPage__topInfoBlockContactLink">
                                            <img src="/images/social1/tw.svg" alt="">
                                        </a>
                                    </div>
                                    <div class="companyPage__topInfoBlockContact">
                                        <a href="" class="companyPage__topInfoBlockContactLink">
                                            <img src="/images/social1/in.svg" alt="">
                                        </a>
                                    </div>
                                    <div class="companyPage__topInfoBlockContact">
                                        <a href="" class="companyPage__topInfoBlockContactLink">
                                            <img src="/images/social1/sk.svg" alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif


                    @if ($company->isTop)
                        @if ($company->shtat || $company->analit || $company->managers || $company->noshtat)
                            <div class="col-lg-6">
                                <div class="companyPage__topInfoBlock">
                                    <div class="companyPage__topInfoBlockTitle">
                                        Сотрудники
                                    </div>
                                    <div class="row">
                                        @if ($company->shtat)
                                            <div class="col-6 col-md-3">
                                                <div class="companyPage__topInfoBlockNums">
                                                    {{ $company->shtat }}
                                                </div>
                                                <p>Штатных Сотрудников</p>
                                            </div>
                                        @endif
                                        @if ($company->noshtat)
                                            <div class="col-6 col-md-3">
                                                <div class="companyPage__topInfoBlockNums">
                                                    {{ $company->noshtat }}
                                                </div>
                                                <p>Внештатных сотрудников</p>
                                            </div>

                                        @endif
                                        @if ($company->analit)
                                            <div class="col-6 col-md-3">
                                                <div class="companyPage__topInfoBlockNums">
                                                    {{ $company->analit }}
                                                </div>
                                                <p>Аналитиков</p>
                                            </div>

                                        @endif
                                        @if ($company->managers)
                                            <div class="col-6 col-md-3">
                                                <div class="companyPage__topInfoBlockNums">
                                                    {{ $company->managers }}
                                                </div>
                                                <p>Менеджеров</p>
                                            </div>

                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif


                </div>
            </div>

            <div class="company_no_cont d-none">
                <img src="/images/social1/no_cont.png" alt=""> Подробная информация о компании отсутствует
            </div>


            <div class="col-12 companyPage__logoDescHolder">
                <div class="row">
                    @if ($company->isTop)
                        @if ($logo)
                            <div class="col-lg-3">
                                <div class="companyPage__logoHolder">
                                    <img src="/storage/{{ $logo->company_logo_name }}" alt="">
                                </div>
                        @endif
                    @endif


                </div>
                @if ($company->isTop)
                    @if ($company->largeText)
                        <div class="col-lg-9">
                            <div class="companyPage__largeDesc">
                                {!! $company->largeText !!}
                            </div>
                        </div>
                    @endif
                @endif
            </div>
        </div>
        <div class="col-12">
            <div class="row">
                @if ($company->isTop)
                    @if ($filials)
                        <div class="col-md-6 col-lg-3">
                            <div class="companyPage__bottomInfoBlock">
                                <div class="companyPage__bottomInfoBlockTitle">
                                    Филиалы
                                </div>
                                @foreach ($filials as $filial)
                                    @foreach ($cities as $city)
                                        @if ($city->id == $filial)
                                            <span>{{ $city->name }}</span>
                                        @endif
                                    @endforeach
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endif

                @if ($company->entity)
                    <div class="col-md-6 col-lg-3">
                        <div class="companyPage__bottomInfoBlock">
                            <div class="companyPage__bottomInfoBlockTitle">
                                Юр.Лицо:
                            </div>
                            <span>{{ $company->entity }}</span>
                        </div>
                    </div>
                @endif
                @if ($company->inn)
                    <div class="col-md-6 col-lg-3">
                        <div class="companyPage__bottomInfoBlock">
                            <div class="companyPage__bottomInfoBlockTitle">
                                ИНН:
                            </div>
                            <span style="color: #2F4E54;">{{ $company->inn }}</span>
                        </div>
                    </div>
                @endif
                @if ($company->ogrn)
                    <div class="col-md-6 col-lg-3">
                        <div class="companyPage__bottomInfoBlock">
                            <div class="companyPage__bottomInfoBlockTitle">
                                ОГРН:
                            </div>
                            <span style="color: #2F4E54;">{{ $company->ogrn }}</span>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="col-12">
            <ul class="nav companyPage__tabsUl scroll_x" id="" role="tablist">
                @if ($spec_works)
                    <li class="nav-item companyPage__tabsLi" role="presentation">
                        <a class="companyPage__tabsLink " id="spec-tab" data-bs-toggle="tab" data-bs-target="#spec"
                            type="button" role="tab" aria-controls="spec" aria-selected="true">Специализации</a>
                    </li>
                @endif
                @if ($field_works)
                    <li class="nav-item companyPage__tabsLi" role="presentation">
                        <a class="companyPage__tabsLink" id="field-tab" data-bs-toggle="tab" data-bs-target="#field"
                            type="button" role="tab" aria-controls="field" aria-selected="false">Проведение полевых
                            работ</a>
                    </li>
                @endif
                @if ($research_solutions_q != null || $research_solutions_own != null)
                    <li class="nav-item companyPage__tabsLi" role="presentation">
                        <a class="companyPage__tabsLink" id="research-tab" data-bs-toggle="tab" data-bs-target="#research"
                            type="button" role="tab" aria-controls="research" aria-selected="false">Решения для рисерча</a>
                    </li>
                @endif

                @if ($company->isTop)
                    @if ($reviews->isNotEmpty())
                        <li class="nav-item companyPage__tabsLi" role="presentation">
                            <a class="companyPage__tabsLink" id="resp-tab" data-bs-toggle="tab" data-bs-target="#resp"
                                type="button" role="tab" aria-controls="resp" aria-selected="false">Отзывы</a>
                        </li>
                    @endif
                @endif
                @if ($bree['company_resources_interviewers'] > 0 || $bree['company_resources_regions'] || $cawi['arr'] || $capi['company_resources_tablets'] || $capi['company_resources_tablets_more'] || $capi['arr'] || $hall['company_resources_placements_area'] || $hall['company_resources_placements'] || $photos_hall_test->isNotEmpty() || $focus['arr'] || $focus['rooms'] || $cati['arr'] || $cati['company_resources_operators'] || $cati['company_resources_work_hours'])

                    <li class="nav-item companyPage__tabsLi" role="presentation">
                        <a class="companyPage__tabsLink " id="resources-tab" data-bs-toggle="tab"
                            data-bs-target="#resources" type="button" role="tab" aria-controls="resources"
                            aria-selected="false">Ресурсы компании</a>
                    </li>
                @endif


            </ul>
            <div class="tab-content" id="">
                @if ($spec_works)
                    <div class="tab-pane fade" id="spec" role="tabpanel" aria-labelledby="spec-tab">

                        @if ($accordion_or_one_block < 2)
                            <!-- if only 1 cat start -->
                            <div class="row tabsContHolder">
                                <div class="col-12 tabsContHolder__title">
                                    @if ($a)
                                        Социологические исследования
                                    @elseif ($b)
                                        Политические исследования
                                    @elseif ($c)
                                        Маркетинговые исследования
                                    @endif
                                </div>
                                <div class="col-12 tabsContHolder__cont">
                                    <div class="row">
                                        @php
                                            $count_spec = count($spec_works);
                                        @endphp
                                        @if ($count_spec < 6)
                                            @php
                                                $break_num = 0;
                                            @endphp

                                            @foreach ($spec_works_items as $item)
                                                @foreach ($spec_works as $work)
                                                    @php
                                                        if ($break_num == 3 && $company->isTop != 1) {
                                                            break;
                                                        }
                                                    @endphp
                                                    @if ($item->spec_item_id == $work)
                                                        <div class="col-12">
                                                            <div class="tabsContHolder__dotItem">
                                                                {{ $item->spec_item_name }}
                                                            </div>
                                                        </div>

                                                        @php
                                                            $break_num++;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        @else
                                            @php
                                                $break_num = 0;
                                            @endphp

                                            @foreach ($spec_works_items as $item)
                                                @foreach ($spec_works as $work)
                                                    @php
                                                        if ($break_num == 3 && $company->isTop != 1) {
                                                            break;
                                                        }
                                                    @endphp
                                                    @if ($item->spec_item_id == $work)
                                                        @if ($company->isTop != 1)
                                                            <div class="col-12">
                                                                <div class="tabsContHolder__dotItem">
                                                                    {{ $item->spec_item_name }}
                                                                </div>
                                                            </div>
                                                        @else
                                                            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                                                <div class="tabsContHolder__dotItem">
                                                                    {{ $item->spec_item_name }}
                                                                </div>
                                                            </div>
                                                        @endif

                                                        @php
                                                            $break_num++;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- if only 1 cat end -->
                        @else
                            <!-- if more 1 cat start -->



                            @php
                                $soc = 0;
                                $pol = 0;
                                $mar = 0;
                            @endphp


                            <div class="accordion" id="accordionExample1">
                                @if ($a == 1)
                                    <div class="accordionItem">
                                        <div class="" id="headingOne">
                                            <a class="tabsContHolder__title_accordion collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                                aria-expanded="false" aria-controls="collapseOne">
                                                Социологические исследования
                                                <svg class="acc_arrow" width="18" height="10" viewBox="0 0 18 10"
                                                    fill="" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M17.4432 0.674524C17.3283 0.559664 17.1421 0.559664 17.0272 0.674524L8.99989 8.70185L0.972567 0.674523C0.857706 0.559662 0.67148 0.559662 0.55662 0.674522C0.441759 0.789383 0.441759 0.975608 0.55662 1.09047L8.79191 9.32576C8.84707 9.38092 8.92188 9.41191 8.99989 9.41191C9.07789 9.41191 9.1527 9.38092 9.20786 9.32576L17.4432 1.09047C17.558 0.975609 17.558 0.789384 17.4432 0.674524Z"
                                                        fill="" />
                                                </svg>

                                            </a>
                                        </div>
                                        <div id="collapseOne" class="accordion-collapse collapse"
                                            aria-labelledby="headingOne" data-bs-parent="#accordionExample1">
                                            <div class="tabsContHolder__body">
                                                <div class="row">
                                                    @php
                                                        $aa = 0;
                                                    @endphp
                                                    @foreach ($spec_works_items_soc as $item)
                                                        @foreach ($spec_works as $work)
                                                            @if ($item->spec_item_id == $work)
                                                                @php
                                                                    $aa++;
                                                                @endphp
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                    @if ($aa < 6)
                                                        @php
                                                            $soc = 0;
                                                        @endphp
                                                        @foreach ($spec_works_items_soc as $item)
                                                            @foreach ($spec_works as $work)
                                                                @php
                                                                    if ($soc == 3 && $company->isTop != 1) {
                                                                        break;
                                                                    }
                                                                @endphp
                                                                @if ($item->spec_item_id == $work)
                                                                    <div class="col-12">
                                                                        <div class="tabsContHolder__dotItem">
                                                                            {{ $item->spec_item_name }}
                                                                        </div>
                                                                    </div>

                                                                    @php
                                                                        $soc++;
                                                                    @endphp
                                                                @endif
                                                            @endforeach
                                                        @endforeach
                                                    @else
                                                        @php
                                                            $soc = 0;
                                                        @endphp

                                                        @foreach ($spec_works_items_soc as $item)
                                                            @foreach ($spec_works as $work)
                                                                @php
                                                                    if ($soc == 3 && $company->isTop != 1) {
                                                                        break;
                                                                    }
                                                                @endphp
                                                                @if ($item->spec_item_id == $work)
                                                                    @if ($company->isTop != 1)
                                                                        <div class="col-12">
                                                                            <div class="tabsContHolder__dotItem">
                                                                                {{ $item->spec_item_name }}
                                                                            </div>
                                                                        </div>
                                                                    @else
                                                                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                                                            <div class="tabsContHolder__dotItem">
                                                                                {{ $item->spec_item_name }}
                                                                            </div>
                                                                        </div>
                                                                    @endif

                                                                    @php
                                                                        $soc++;
                                                                    @endphp
                                                                @endif
                                                            @endforeach
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if ($b == 1)
                                    <div class="accordionItem">
                                        <div class="" id="headingTwo">
                                            <a class="tabsContHolder__title_accordion collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                aria-expanded="false" aria-controls="collapseTwo">
                                                Политические исследования
                                                <svg class="acc_arrow" width="18" height="10" viewBox="0 0 18 10"
                                                    fill="" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M17.4432 0.674524C17.3283 0.559664 17.1421 0.559664 17.0272 0.674524L8.99989 8.70185L0.972567 0.674523C0.857706 0.559662 0.67148 0.559662 0.55662 0.674522C0.441759 0.789383 0.441759 0.975608 0.55662 1.09047L8.79191 9.32576C8.84707 9.38092 8.92188 9.41191 8.99989 9.41191C9.07789 9.41191 9.1527 9.38092 9.20786 9.32576L17.4432 1.09047C17.558 0.975609 17.558 0.789384 17.4432 0.674524Z"
                                                        fill="" />
                                                </svg>
                                            </a>
                                        </div>
                                        <div id="collapseTwo" class="accordion-collapse collapse"
                                            aria-labelledby="headingTwo" data-bs-parent="#accordionExample1">
                                            <div class="tabsContHolder__body">
                                                <div class="row">
                                                    @php
                                                        $bb = 0;
                                                    @endphp
                                                    @foreach ($spec_works_items_pol as $item)
                                                        @foreach ($spec_works as $work)
                                                            @if ($item->spec_item_id == $work)
                                                                @php
                                                                    $bb++;
                                                                @endphp
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                    @if ($bb < 6)
                                                        @php
                                                            $pol = 0;
                                                        @endphp
                                                        @foreach ($spec_works_items_pol as $item)
                                                            @foreach ($spec_works as $work)
                                                                @php
                                                                    if ($pol == 3 && $company->isTop != 1) {
                                                                        break;
                                                                    }
                                                                @endphp
                                                                @if ($item->spec_item_id == $work)
                                                                    <div class="col-12">
                                                                        <div class="tabsContHolder__dotItem">
                                                                            {{ $item->spec_item_name }}
                                                                        </div>
                                                                    </div>

                                                                    @php
                                                                        $pol++;
                                                                    @endphp
                                                                @endif
                                                            @endforeach
                                                        @endforeach
                                                    @else
                                                        @php
                                                            $pol = 0;
                                                        @endphp

                                                        @foreach ($spec_works_items_pol as $item)
                                                            @foreach ($spec_works as $work)
                                                                @php
                                                                    if ($pol == 3 && $company->isTop != 1) {
                                                                        break;
                                                                    }
                                                                @endphp
                                                                @if ($item->spec_item_id == $work)
                                                                    @if ($company->isTop != 1)
                                                                        <div class="col-12">
                                                                            <div class="tabsContHolder__dotItem">
                                                                                {{ $item->spec_item_name }}
                                                                            </div>
                                                                        </div>
                                                                    @else
                                                                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                                                            <div class="tabsContHolder__dotItem">
                                                                                {{ $item->spec_item_name }}
                                                                            </div>
                                                                        </div>
                                                                    @endif

                                                                    @php
                                                                        $pol++;
                                                                    @endphp
                                                                @endif
                                                            @endforeach
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if ($c == 1)
                                    <div class="accordionItem">
                                        <div class="" id="headingThree">
                                            <a class="tabsContHolder__title_accordion collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                                aria-expanded="false" aria-controls="collapseThree">
                                                Маркетинговые исследования
                                                <svg class="acc_arrow" width="18" height="10" viewBox="0 0 18 10"
                                                    fill="" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M17.4432 0.674524C17.3283 0.559664 17.1421 0.559664 17.0272 0.674524L8.99989 8.70185L0.972567 0.674523C0.857706 0.559662 0.67148 0.559662 0.55662 0.674522C0.441759 0.789383 0.441759 0.975608 0.55662 1.09047L8.79191 9.32576C8.84707 9.38092 8.92188 9.41191 8.99989 9.41191C9.07789 9.41191 9.1527 9.38092 9.20786 9.32576L17.4432 1.09047C17.558 0.975609 17.558 0.789384 17.4432 0.674524Z"
                                                        fill="" />
                                                </svg>
                                            </a>
                                        </div>
                                        <div id="collapseThree" class="accordion-collapse collapse"
                                            aria-labelledby="headingThree" data-bs-parent="#accordionExample1">
                                            <div class="tabsContHolder__body">
                                                <div class="row">
                                                    @php
                                                        $cc = 0;
                                                    @endphp
                                                    @foreach ($spec_works_items_mar as $item)
                                                        @foreach ($spec_works as $work)
                                                            @if ($item->spec_item_id == $work)
                                                                @php
                                                                    $cc++;
                                                                @endphp
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                    @if ($cc < 6)
                                                        @php
                                                            $mar = 0;
                                                        @endphp
                                                        @foreach ($spec_works_items_mar as $item)
                                                            @foreach ($spec_works as $work)
                                                                @php
                                                                    if ($mar == 3 && $company->isTop != 1) {
                                                                        break;
                                                                    }
                                                                @endphp
                                                                @if ($item->spec_item_id == $work)
                                                                    <div class="col-12">
                                                                        <div class="tabsContHolder__dotItem">
                                                                            {{ $item->spec_item_name }}
                                                                        </div>
                                                                    </div>

                                                                    @php
                                                                        $mar++;
                                                                    @endphp
                                                                @endif
                                                            @endforeach
                                                        @endforeach
                                                    @else
                                                        @php
                                                            $mar = 0;
                                                        @endphp

                                                        @foreach ($spec_works_items_mar as $item)
                                                            @foreach ($spec_works as $work)
                                                                @php
                                                                    if ($mar == 3 && $company->isTop != 1) {
                                                                        break;
                                                                    }
                                                                @endphp
                                                                @if ($item->spec_item_id == $work)
                                                                    @if ($company->isTop != 1)
                                                                        <div class="col-12">
                                                                            <div class="tabsContHolder__dotItem">
                                                                                {{ $item->spec_item_name }}
                                                                            </div>
                                                                        </div>
                                                                    @else
                                                                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                                                            <div class="tabsContHolder__dotItem">
                                                                                {{ $item->spec_item_name }}
                                                                            </div>
                                                                        </div>
                                                                    @endif

                                                                    @php
                                                                        $mar++;
                                                                    @endphp
                                                                @endif
                                                            @endforeach
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                            </div>


                        @endif

                    </div>
                @endif
                @if ($field_works)
                    <div class="tab-pane fade" id="field" role="tabpanel" aria-labelledby="field-tab">

                        <div class="row tabsContHolder">
                            <div class="col-12 tabsContHolder__cont">
                                <div class="row">
                                    @foreach ($field_works as $fw)
                                        @foreach ($field_works_items as $fwi)
                                            @if ($fwi->field_works_item_id == $fw)
                                                <div class="col-12">
                                                    <div class="tabsContHolder__dotItem">
                                                        {{ $fwi->field_works_item_name }}
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </div>
                @endif


                @if ($research_solutions_q != null || $research_solutions_own != null)
                    <div class="tab-pane fade" id="research" role="tabpanel" aria-labelledby="research-tab">
                        @php
                            $count_q = count($research_solutions_q);
                            $count_own_array = 0;
                            foreach ($research_solutions_own as $value) {
                                if ($value !== null) {
                                    $count_own_array += 1;
                                }
                            }

                            $qu = 0;
                            $own = 0;
                            $count_own = 3 - $count_q;
                        @endphp

                        <div class="row tabsContHolder">
                            <div class="col-12 tabsContHolder__cont">
                                <div class="row">
                                    @if (!$company->isTop)

                                        @if ($research_solutions_q)
                                            @foreach ($research_solutions_items as $rs_items)
                                                @foreach ($research_solutions_q as $q)
                                                    @if ($rs_items->research_solutions_items_id == $q)
                                                        @php
                                                            if ($company->isTop != 1 && $qu == 3) {
                                                                break;
                                                            }
                                                            $qu++;
                                                        @endphp
                                                        <div class="col-12">
                                                            <div class="tabsContHolder__dotItem">
                                                                {{ $rs_items->research_solutions_items_name }}
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        @endif
                                        @if ($count_own > 0)
                                            @if ($research_solutions_own)
                                                @for ($i = 0; $i < 3; $i++)
                                                    @if ($research_solutions_own[$i] != null)
                                                        @php
                                                            if ($company->isTop != 1 && $own == $count_own) {
                                                                break;
                                                            }
                                                            $own++;
                                                        @endphp
                                                        @if ($count_q + $count_own_array < 6)
                                                            <div class="col-12">
                                                                <div class="tabsContHolder__dotItem">
                                                                    {{ $research_solutions_own[$i] }}
                                                                </div>
                                                            </div>
                                                        @else
                                                            <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                                                                <div class="tabsContHolder__dotItem">
                                                                    {{ $research_solutions_own[$i] }}
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endif
                                                @endfor
                                            @endif
                                        @endif
                                    @elseif ($company->isTop)
                                        @if ($research_solutions_q)
                                            @foreach ($research_solutions_items as $rs_items)
                                                @foreach ($research_solutions_q as $q)
                                                    @if ($rs_items->research_solutions_items_id == $q)
                                                        @php
                                                            if ($company->isTop != 1 && $qu == 3) {
                                                                break;
                                                            }
                                                            $qu++;
                                                        @endphp
                                                        @if ($count_q + $count_own_array < 6)
                                                            <div class="col-12">
                                                                <div class="tabsContHolder__dotItem">
                                                                    {{ $rs_items->research_solutions_items_name }}
                                                                </div>
                                                            </div>
                                                        @else
                                                            <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                                                                <div class="tabsContHolder__dotItem">
                                                                    {{ $rs_items->research_solutions_items_name }}
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        @endif
                                        @if ($research_solutions_own)
                                            @for ($i = 0; $i < 3; $i++)
                                                @if ($research_solutions_own[$i] != null)
                                                    @php
                                                        if ($company->isTop != 1 && $own == $count_own) {
                                                            break;
                                                        }
                                                        $own++;
                                                    @endphp
                                                    @if ($count_q + $count_own_array < 6)
                                                        <div class="col-12">
                                                            <div class="tabsContHolder__dotItem">
                                                                {{ $research_solutions_own[$i] }}

                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                                                            <div class="tabsContHolder__dotItem">
                                                                {{ $research_solutions_own[$i] }}
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endif
                                            @endfor
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endif



                <div class="tab-pane fade" id="resources" role="tabpanel" aria-labelledby="resources-tab">
                    <div class="accordion" id="accordionExample333">

                        {{-- cati- --}}
                        @if ($cati['arr'] || $cati['company_resources_operators'] || $cati['company_resources_work_hours'])
                            <div class="accordionItem">
                                <div class="" id="heading111">
                                    <a class="tabsContHolder__title_accordion collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapse111" aria-expanded="false"
                                        aria-controls="collapse111">
                                        CATI
                                        <svg class="acc_arrow" width="18" height="10" viewBox="0 0 18 10" fill=""
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M17.4432 0.674524C17.3283 0.559664 17.1421 0.559664 17.0272 0.674524L8.99989 8.70185L0.972567 0.674523C0.857706 0.559662 0.67148 0.559662 0.55662 0.674522C0.441759 0.789383 0.441759 0.975608 0.55662 1.09047L8.79191 9.32576C8.84707 9.38092 8.92188 9.41191 8.99989 9.41191C9.07789 9.41191 9.1527 9.38092 9.20786 9.32576L17.4432 1.09047C17.558 0.975609 17.558 0.789384 17.4432 0.674524Z"
                                                fill="" />
                                        </svg>

                                    </a>
                                </div>

                                <div id="collapse111" class="accordion-collapse collapse" aria-labelledby="heading111"
                                    data-bs-parent="#accordionExample333">
                                    <div class="tabsContHolder__body">
                                        <div class="row">
                                            <div class="col-12">
                                                @foreach ($resources_items as $item)
                                                    @if ($item->resources_items_cat == 1)
                                                        @if ($item->resources_items_type == 'checkbox')
                                                            @if ($cati['arr'])
                                                                @foreach ($cati['arr'] as $r)
                                                                    @if ($item->resources_items_id == $r)
                                                                        <div class="tabsContHolder__dotItem">
                                                                            {{ $item->resources_items_name }}
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        @else
                                                            @if ($item->resources_items_id == 3)
                                                                @if ($cati['company_resources_operators'])
                                                                    <div class="tabsContHolder__dotItem">
                                                                        {{ $item->resources_items_name }}:
                                                                        {{ $cati['company_resources_operators'] }}
                                                                    </div>
                                                                @endif
                                                            @endif
                                                            @if ($item->resources_items_id == 4)
                                                                @if ($cati['company_resources_work_hours'])
                                                                    <div class="tabsContHolder__dotItem">
                                                                        {{ $item->resources_items_name }}:
                                                                        {{ $cati['company_resources_work_hours'] }}
                                                                    </div>
                                                                @endif
                                                            @endif
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif


                        {{-- Фокус-групповые --}}
                        @if ($focus['arr'] || $focus['rooms'])
                            <div class="accordionItem">
                                <div class="" id="heading222">
                                    <a class="tabsContHolder__title_accordion collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapse222" aria-expanded="false"
                                        aria-controls="collapse222">
                                        Фокус-групповые
                                        <svg class="acc_arrow" width="18" height="10" viewBox="0 0 18 10" fill=""
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M17.4432 0.674524C17.3283 0.559664 17.1421 0.559664 17.0272 0.674524L8.99989 8.70185L0.972567 0.674523C0.857706 0.559662 0.67148 0.559662 0.55662 0.674522C0.441759 0.789383 0.441759 0.975608 0.55662 1.09047L8.79191 9.32576C8.84707 9.38092 8.92188 9.41191 8.99989 9.41191C9.07789 9.41191 9.1527 9.38092 9.20786 9.32576L17.4432 1.09047C17.558 0.975609 17.558 0.789384 17.4432 0.674524Z"
                                                fill="" />
                                        </svg>

                                    </a>
                                </div>

                                <div id="collapse222" class="accordion-collapse collapse" aria-labelledby="heading222"
                                    data-bs-parent="#accordionExample333">
                                    <div class="tabsContHolder__body">
                                        <div class="row">
                                            @if ($photos_focus_rooms->count() < 1)
                                                <div class="col-12">
                                                @else
                                                    <div class="col-lg-3">
                                            @endif
                                            @foreach ($resources_items as $item)
                                                @if ($item->resources_items_type == 'checkbox')
                                                    @if ($focus['arr'])
                                                        @foreach ($focus['arr'] as $r)
                                                            @if ($item->resources_items_id == $r)
                                                                <div class="tabsContHolder__dotItem">
                                                                    {{ $item->resources_items_name }}
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @else
                                                    @if ($item->resources_items_id == 5)
                                                        @if ($company_resources_focus_rooms > 0)
                                                            <div class="tabsContHolder__dotItem">
                                                                {{ $item->resources_items_name }}:
                                                                {{ $company_resources_focus_rooms }}
                                                            </div>
                                                        @endif
                                                    @endif
                                                @endif
                                            @endforeach
                                        </div>

                                        @if ($company->isTop)
                                            @if ($focus['arr'] || $company_resources_focus_rooms > 0)
                                                <div class="col-lg-9 photosBlock">
                                                @else
                                                    <div class="col-12 photosBlock">
                                            @endif
                                            <section class="row photosHolder center">
                                                @foreach ($photos_focus_rooms as $photo)
                                                    <div class="col-md-6 col-lg-4">
                                                        <div class="photoHolder">
                                                            <a class="photoInner"
                                                                href="/storage/{{ $photo->path }}">
                                                                <img title="{{ $photo->description }}"
                                                                    src="/storage/{{ $photo->path }}"
                                                                    class="photos_images">
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </section>
                                        @endif
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                @endif


                {{-- Hall-test-групповые --}}
                @if ($hall['company_resources_placements_area'] || $hall['company_resources_placements'] || $photos_hall_test->isNotEmpty())
                    <div class="accordionItem">
                        <div class="" id="heading333">
                            <a class="tabsContHolder__title_accordion collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse333" aria-expanded="false" aria-controls="collapse333">
                                Hall-test
                                <svg class="acc_arrow" width="18" height="10" viewBox="0 0 18 10" fill=""
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M17.4432 0.674524C17.3283 0.559664 17.1421 0.559664 17.0272 0.674524L8.99989 8.70185L0.972567 0.674523C0.857706 0.559662 0.67148 0.559662 0.55662 0.674522C0.441759 0.789383 0.441759 0.975608 0.55662 1.09047L8.79191 9.32576C8.84707 9.38092 8.92188 9.41191 8.99989 9.41191C9.07789 9.41191 9.1527 9.38092 9.20786 9.32576L17.4432 1.09047C17.558 0.975609 17.558 0.789384 17.4432 0.674524Z"
                                        fill="" />
                                </svg>

                            </a>
                        </div>

                        <div id="collapse333" class="accordion-collapse collapse" aria-labelledby="heading333"
                            data-bs-parent="#accordionExample333">
                            <div class="tabsContHolder__body">
                                <div class="row">
                                    @if ($photos_hall_test->count() < 1)
                                        <div class="col-12">
                                        @else
                                            <div class="col-lg-3">
                                    @endif
                                    @foreach ($resources_items as $item)
                                        @if ($item->resources_items_type == 'checkbox')
                                            @if ($hall['arr'])
                                                @foreach ($hall['arr'] as $r)
                                                    @if ($item->resources_items_id == $r)
                                                        <div class="tabsContHolder__dotItem">
                                                            {{ $item->resources_items_name }}
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @endif
                                        @else
                                            @if ($item->resources_items_id == 16)
                                                @if ($hall['company_resources_placements'])
                                                    <div class="col-12">
                                                        <div class="tabsContHolder__dotItem">
                                                            {{ $item->resources_items_name }}:
                                                            <strong>{{ $hall['company_resources_placements'] }}</strong>
                                                        </div>
                                                    </div>
                                                @endif
                                            @elseif ($item->resources_items_id == 17)
                                                @if ($hall['company_resources_placements_area'])
                                                    <div class="col-12">
                                                        <div class="tabsContHolder__dotItem">
                                                            {{ $item->resources_items_name }}:
                                                            <strong>{{ $hall['company_resources_placements_area'] }}</strong>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endif
                                        @endif
                                    @endforeach
                                </div>
                                @if ($company->isTop)
                                    @if ($hall['company_resources_placements_area'] || $hall['company_resources_placements'])
                                        <div class="col-lg-9 photosBlock">
                                        @else
                                            <div class="col-12 photosBlock">
                                    @endif
                                    <section class="row photosHolder center">
                                        @foreach ($photos_hall_test as $photo)
                                            <div class="col-md-6 col-lg-4">
                                                <div class="photoHolder">
                                                    <a class="photoInner" href="/storage/{{ $photo->path }}">
                                                        <img title="{{ $photo->description }}"
                                                            src="/storage/{{ $photo->path }}" class="photos_images">
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </section>
                            </div>
                @endif
            </div>
        </div>
        </div>
        </div>
        @endif

        {{-- capi -групповые --}}
        @if ($capi['company_resources_tablets'] || $capi['company_resources_tablets_more'] || $capi['arr'])
            <div class="accordionItem">
                <div class="" id="heading444">
                    <a class="tabsContHolder__title_accordion collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapse444" aria-expanded="false" aria-controls="collapse444">
                        CAPI
                        <svg class="acc_arrow" width="18" height="10" viewBox="0 0 18 10" fill=""
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M17.4432 0.674524C17.3283 0.559664 17.1421 0.559664 17.0272 0.674524L8.99989 8.70185L0.972567 0.674523C0.857706 0.559662 0.67148 0.559662 0.55662 0.674522C0.441759 0.789383 0.441759 0.975608 0.55662 1.09047L8.79191 9.32576C8.84707 9.38092 8.92188 9.41191 8.99989 9.41191C9.07789 9.41191 9.1527 9.38092 9.20786 9.32576L17.4432 1.09047C17.558 0.975609 17.558 0.789384 17.4432 0.674524Z"
                                fill="" />
                        </svg>

                    </a>
                </div>

                <div id="collapse444" class="accordion-collapse collapse" aria-labelledby="heading444"
                    data-bs-parent="#accordionExample333">
                    <div class="tabsContHolder__body">
                        <div class="row">
                            @foreach ($resources_items as $item)
                                @if ($item->resources_items_type == 'checkbox')
                                    @if ($capi['arr'])
                                        @foreach ($capi['arr'] as $r)
                                            @if ($item->resources_items_id == $r)
                                                <div class="col-12">
                                                    <div class="tabsContHolder__dotItem">
                                                        {{ $item->resources_items_name }}
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                @else
                                    @if ($item->resources_items_id == 19)
                                        @if ($capi['company_resources_tablets'])
                                            <div class="col-12">
                                                <div class="tabsContHolder__dotItem">
                                                    {{ $item->resources_items_name }}:
                                                    <strong>{{ $capi['company_resources_tablets'] }}</strong>
                                                </div>
                                            </div>
                                        @endif
                                    @elseif ($item->resources_items_id == 20)
                                        @if ($capi['company_resources_tablets_more'])
                                            <div class="col-12">
                                                <div class="tabsContHolder__dotItem">
                                                    {{ $item->resources_items_name }}:
                                                    {{ $capi['company_resources_tablets_more'] }}
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif




        {{-- cawi -групповые --}}
        @if ($cawi['arr'])
            <div class="accordionItem">
                <div class="" id="heading555">
                    <a class="tabsContHolder__title_accordion collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapse555" aria-expanded="false" aria-controls="collapse555">
                        CAWI
                        <svg class="acc_arrow" width="18" height="10" viewBox="0 0 18 10" fill=""
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M17.4432 0.674524C17.3283 0.559664 17.1421 0.559664 17.0272 0.674524L8.99989 8.70185L0.972567 0.674523C0.857706 0.559662 0.67148 0.559662 0.55662 0.674522C0.441759 0.789383 0.441759 0.975608 0.55662 1.09047L8.79191 9.32576C8.84707 9.38092 8.92188 9.41191 8.99989 9.41191C9.07789 9.41191 9.1527 9.38092 9.20786 9.32576L17.4432 1.09047C17.558 0.975609 17.558 0.789384 17.4432 0.674524Z"
                                fill="" />
                        </svg>

                    </a>
                </div>

                <div id="collapse555" class="accordion-collapse collapse" aria-labelledby="heading555"
                    data-bs-parent="#accordionExample333">
                    <div class="tabsContHolder__body">
                        <div class="row">
                            @foreach ($resources_items as $item)
                                @if ($cawi['arr'])
                                    @foreach ($cawi['arr'] as $r)
                                        @if ($item->resources_items_id == $r)
                                            <div class="col-12">
                                                <div class="tabsContHolder__dotItem">
                                                    {{ $item->resources_items_name }}
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif


        {{-- bree --}}
        @if ($bree['company_resources_interviewers'] > 0 || $bree['company_resources_regions'])
            <div class="accordionItem">
                <div class="" id="heading666">
                    <a class="tabsContHolder__title_accordion collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapse666" aria-expanded="false" aria-controls="collapse666">
                        Выездные бригады интервьюеров
                        <svg class="acc_arrow" width="18" height="10" viewBox="0 0 18 10" fill=""
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M17.4432 0.674524C17.3283 0.559664 17.1421 0.559664 17.0272 0.674524L8.99989 8.70185L0.972567 0.674523C0.857706 0.559662 0.67148 0.559662 0.55662 0.674522C0.441759 0.789383 0.441759 0.975608 0.55662 1.09047L8.79191 9.32576C8.84707 9.38092 8.92188 9.41191 8.99989 9.41191C9.07789 9.41191 9.1527 9.38092 9.20786 9.32576L17.4432 1.09047C17.558 0.975609 17.558 0.789384 17.4432 0.674524Z"
                                fill="" />
                        </svg>

                    </a>
                </div>

                <div id="collapse666" class="accordion-collapse collapse" aria-labelledby="heading666"
                    data-bs-parent="#accordionExample333">
                    <div class="tabsContHolder__body">
                        <div class="row">

                            @foreach ($resources_items as $item)
                                @if ($item->resources_items_type == 'checkbox')
                                @else
                                    @if ($item->resources_items_id == 29)
                                        @if ($bree['company_resources_interviewers'] > 0)
                                            <div class="col-12">
                                                <div class="tabsContHolder__dotItem">
                                                    {{ $item->resources_items_name }}:
                                                    <strong>{{ $bree['company_resources_interviewers'] }}</strong>
                                                </div>
                                            </div>
                                        @endif
                                    @elseif ($item->resources_items_id == 30)
                                        </ul>
                                        @if ($company->isTop)
                                            @if ($bree['company_resources_regions'])
                                                <div class="col-12">
                                                    <style>
                                                        .regions_list span:last-of-type {
                                                            display: none;
                                                        }

                                                    </style>
                                                    <div class="tabsContHolder__dotItem ">
                                                        <div class="regions_list">
                                                            {{ $item->resources_items_name }}:


                                                            @foreach ($regions as $r)
                                                                @if ($company_regions)
                                                                    @foreach ($company_regions as $cr)
                                                                        @if ($r->id == $cr)
                                                                            <span>{{ $r->name }}</span><span
                                                                                class="regions_list_coma">,</span>
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endif
                                    @endif
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif

        </div>
        </div>

        <style>
            .companyPage .photosBlock .photoHolder {
                padding-top: 100%;
            }

            .companyPage .photosBlock .photoHolder.pdf {
                display: flex;
                align-items: center;
                justify-content: center;
                background: #F1F2F3;
                border-radius: 10px;
            }

        </style>


        @if ($company->isTop)
            @if ($reviews->isNotEmpty())
                <div class="tab-pane fade" id="resp" role="tabpanel" aria-labelledby="resp-tab">
                    <div class=" photosBlock">
                        <div class="">
                            <section class="row photosHolder center slider ">
                                @foreach ($reviews as $review)
                                    <div class="single col-6 col-sm-4 col-md-3 col-lg-2">
                                        @php
                                            $ext = explode('.', $review->file);
                                            $ext = $ext[1];
                                        @endphp
                                        @if ($ext === 'pdf')
                                            <div class="photoHolder pdf">
                                                <div class="photoInner">
                                                    <img OnClick="window.open('/storage/{{ $review->file }}', '_blank')  "
                                                        title="{{ $review->title }}" src="/images/pdf_ext.png"
                                                        style="cursor: pointer; object-fit: none;">
                                                </div>
                                            </div>
                                        @else
                                            <div class="photoHolder">
                                                <a class="photoInner" href="/storage/{{ $review->file }}">
                                                    <img title="{{ $review->title }}"
                                                        src="/storage/{{ $review->file }}">
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </section>
                        </div>
                    </div>
                </div>
            @endif
        @endif





        </div>







        </div>

        </div>



        </div>
        </div>
        </div>
        </div>
    </main>



@endsection

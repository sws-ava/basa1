@extends('layouts/main_layout')


@section('title', 'Значки - описание')


@section('content')


    <main class="main">
        <div class="container">
            <div class="row">
                <div class="col-12 badges">
                    <div class="title">
                        <h1>Описание значков</h1>
                        <ul class="breadCrumbs">
                            <li>
                                <a href="/">Атлас</a>

                            </li>
                            <li>/описание значков</li>
                        </ul>
                    </div>
                    <div class="badgesHolder">
                        <div class="row">

                            @foreach ($badges as $badge)
                                <div class="col-sm-6 col-md-6 col-xl-4">
                                    <div class="badgeItemHolder">
                                        <div class="badgeItemInner">
                                            <div class="imageHolder">
                                                <img style="width: 45px;" src="{{ $badge['img'] }}" alt="" />
                                                <div class="times"></div>
                                            </div>
                                            <div class="name mb-2">
                                                {{ $badge['title'] }}
                                            </div>
                                            <div class="desc">{{ $badge['description'] }}</div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="moreDesc">
                        * Число в логотипе указывает на количество раз, которое компания принимала участие в качестве
                        экспонента выставки
                    </div>
                </div>
            </div>
        </div>
    </main>


@endsection

@extends('layouts/main_layout')


@section('title', 'О компании')


@section('content')


    <main class="main">
        <div class="container">
            <div class="row ">
                <div class="col-12 about">
                    <div class="title">
                        <h1>О проекте</h1>
                        <ul class="breadCrumbs">
                            <li>
                                <router-link :to="{ name: 'welcome' }" class="">
                                    Атлас
                                </router-link>
                            </li>
                            <li>/О проекте</li>
                        </ul>
                    </div>
                    {!! $page->content !!}

                    <div class="row">
                        <div class="col-12">
                            <div class="formHolder">
                                <h3>Связь с нами</h3>
                                <p>
                                    Если у Вас есть замечание или предложение по работе проекта “Атлас”, Вы можете написать
                                    нам и мы рассмотри ваш запрос.
                                </p>
                                <form class="form sendFeedback" action="">
                                    @csrf
                                    <label for="">Имя</label>
                                    <input class="inputField formName" name="name" type="text"
                                        placeholder="Введите ваше имя" required />
                                    <label for="">Почта</label>
                                    <input class="inputField formMail" name="mail" type="text"
                                        placeholder="Введите вашу почту" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"
                                        required />
                                    <label for="">Текст сообщения</label>
                                    <textarea class="inputField formText" name="text" id="" cols="30" rows="10"
                                        placeholder="Опишите проблему/предложение"></textarea>
                                    <button class="greenBtn opacityHover sendMail">Отправить</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <style>
        .modal-body {
            text-align: center;
            position: relative;
        }

        .modal-body .closeModal {
            position: absolute;
            right: 20px;
            top: 20px;
            cursor: pointer;
        }

        .modal-body .image {
            margin: 30px auto 20px;
        }

        .modal-body .header {
            font-weight: 500;
            font-size: 20px;
            line-height: 24px;
            color: #2F4E54;
            margin-bottom: 10px;
            text-align: center;
        }



        .modal-body .text {
            font-weight: 300;
            font-size: 16px;
            line-height: 140%;
            color: #2F4E54;
            max-width: 337px;
            margin: 0 auto 30px;
        }

        .modal-body .greenBtn {
            width: 184px;
            margin: 0 auto 15px;
        }

    </style>

    <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <img src="/images/closeModal.svg" data-bs-dismiss="modal" class="closeModal">
                    <img class="image" src="/images/sended.png" alt="">
                    <div class="header">
                        Готово!
                    </div>
                    <div class="text">
                        Мы получили Ваше письмо, ожидайте ответ в ближайшее время.
                    </div>
                    <button type="button" class="greenBtn opacityHover" data-bs-dismiss="modal">Закрыть</button>
                </div>
            </div>
        </div>
    </div>



@endsection
